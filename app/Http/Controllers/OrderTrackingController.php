<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CustomRequest;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('tracking');
    }

    public function search(Request $request)
    {
        $code = $request->query('code');
        $order = null;
        $customRequest = null;
        $userOrders = collect();

        if (auth()->check()) {
            $orders = Order::where('customer_name', auth()->user()->name)->latest()->get();
            $requests = CustomRequest::where('customer_name', auth()->user()->name)
                ->whereIn('status', ['menunggu', 'dibatalkan'])
                ->latest()
                ->get()
                ->map(function($req) {
                    $req->is_custom_request = true;
                    $req->product = ($req->model ?? 'Custom') . ' Custom (Request)';
                    $req->qty = 1;
                    $req->price = 0;
                    return $req;
                });

            $userOrders = $orders->concat($requests)->sortByDesc('created_at');

            if (!$code && $userOrders->isNotEmpty()) {
                $code = $userOrders->first()->code;
            }
        }

        if ($code) {
            $order = Order::where('code', $code)->first();
            if (!$order) {
                $customRequest = CustomRequest::where('code', $code)->first();
            }
        }
        $existingReview = null;
        if ($order && $order->status === 'selesai') {
            $existingReview = \App\Models\ProductReview::where('order_code', $order->code)->first();
        }
        
        return view('tracking', compact('order', 'customRequest', 'code', 'userOrders', 'existingReview'));
    }

    public function uploadReceipt(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();

        $request->validate([
            'receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('receipt')) {
            $file = $request->file('receipt');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Create receipts directory if it doesn't exist
            $uploadPath = public_path('uploads/receipts');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $filename);
            
            // Delete old receipt if it exists
            if ($order->payment_receipt && file_exists(public_path($order->payment_receipt))) {
                @unlink(public_path($order->payment_receipt));
            }
            
            $order->update([
                'payment_receipt' => 'uploads/receipts/' . $filename,
                'status' => 'menunggu_verifikasi',
            ]);

            return redirect()->route('tracking', ['code' => $code])->with('success', 'Bukti transfer berhasil diunggah! Mohon tunggu verifikasi oleh admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti transfer.');
    }

    public function simulatePayment(Request $request, $code)
    {
        $order = Order::where('code', $code)->firstOrFail();
        $method = $request->input('payment_method', 'QRIS');

        $order->update([
            'status' => 'produksi',
            'notes' => 'Pembayaran otomatis terverifikasi via ' . strtoupper($method) . ' (Simulasi Gateway).',
        ]);

        return redirect()->route('tracking', ['code' => $code])->with('success', 'Pembayaran via ' . strtoupper($method) . ' berhasil dideteksi secara otomatis! Pesanan Anda telah terverifikasi dan masuk ke proses produksi.');
    }

    /**
     * Handle QRIS QR code scan from phone.
     * Verifies the order payment automatically and returns a mobile-friendly success page.
     */
    public function qrisVerify(Request $request, $code)
    {
        $order = Order::where('code', $code)->first();

        if (!$order) {
            return response()->view('qris_result', [
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.',
                'code'    => $code,
            ], 404);
        }

        if ($order->status !== 'pending') {
            return view('qris_result', [
                'success'      => true,
                'alreadyPaid'  => true,
                'message'      => 'Pembayaran sudah terverifikasi sebelumnya. Terima kasih!',
                'order'        => $order,
            ]);
        }

        $order->update([
            'status' => 'produksi',
            'notes'  => 'Pembayaran otomatis terverifikasi via QRIS (Scan dari HP Customer).',
        ]);

        return view('qris_result', [
            'success'     => true,
            'alreadyPaid' => false,
            'message'     => 'Pembayaran QRIS berhasil! Pesanan Anda sedang diproses.',
            'order'       => $order,
        ]);
    }

    /**
     * Return JSON status of an order for polling.
     */
    public function orderStatus(Request $request, $code)
    {
        $order = Order::where('code', $code)->first();

        if (!$order) {
            return response()->json(['status' => 'not_found'], 404);
        }

        return response()->json([
            'status'  => $order->status,
            'pending' => $order->status === 'pending',
        ]);
    }
}
