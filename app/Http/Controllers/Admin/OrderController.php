<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        
        $query = Order::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->paginate(15);
        return view('admin.orders', compact('orders', 'search', 'status'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $customer = \App\Models\Customer::where('name', $order->customer_name)->first();
        $customRequest = \App\Models\CustomRequest::where('customer_name', $order->customer_name)->first();
        return view('admin.order_show', compact('order', 'customer', 'customRequest'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,menunggu_verifikasi,produksi,finishing,siap_dikirim,selesai'],
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status pesanan diperbarui');
    }

    public function verifyPayment(Order $order)
    {
        $order->update(['status' => 'produksi']);
        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi. Pesanan masuk ke proses produksi.');
    }

    public function rejectPayment(Order $order)
    {
        if ($order->payment_receipt && file_exists(public_path($order->payment_receipt))) {
            @unlink(public_path($order->payment_receipt));
        }

        $order->update([
            'payment_receipt' => null,
            'status' => 'pending',
            'notes' => 'Bukti pembayaran sebelumnya ditolak oleh admin. Harap unggah bukti pembayaran yang valid.',
        ]);

        return redirect()->back()->with('success', 'Pembayaran ditolak. Pesanan dikembalikan ke status Pending.');
    }
}
