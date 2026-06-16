<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

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
        $userOrders = collect();

        if (auth()->check()) {
            $userOrders = Order::where('customer_name', auth()->user()->name)->latest()->get();
            if (!$code && $userOrders->isNotEmpty()) {
                $code = $userOrders->first()->code;
            }
        }

        if ($code) {
            $order = Order::where('code', $code)->first();
        }
        
        return view('tracking', compact('order', 'code', 'userOrders'));
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
}
