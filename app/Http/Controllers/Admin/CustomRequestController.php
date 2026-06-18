<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomRequest;

class CustomRequestController extends Controller
{
    public function index()
    {
        $requests = CustomRequest::latest()->paginate(15);
        return view('admin.custom_requests', compact('requests'));
    }

    public function show($id)
    {
        $req = CustomRequest::findOrFail($id);
        return view('admin.custom_request_show', compact('req'));
    }

    public function updateStatus(Request $request, CustomRequest $customRequest)
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,diproses,selesai,dibatalkan'],
        ]);

        if ($request->status === 'diproses') {
            $request->validate([
                'price' => 'required|string',
                'estimation' => 'required|string',
            ]);

            // Strip currency formatting to get clean integer
            $cleanPrice = intval(preg_replace('/[^0-9]/', '', $request->price));

            // Generate unique tracking code
            do {
                $code = 'ZW-CST-' . strtoupper(\Illuminate\Support\Str::random(5));
            } while (\App\Models\Order::where('code', $code)->exists());

            // Create order with pending status (waiting for customer payment upload)
            \App\Models\Order::create([
                'code' => $code,
                'customer_name' => $customRequest->customer_name,
                'product' => ($customRequest->model ?? 'Custom') . ' Custom',
                'qty' => 1,
                'price' => $cleanPrice,
                'status' => 'pending',
                'notes' => 'Estimasi: ' . $request->estimation . '. Warna: ' . $customRequest->color . '. Catatan: ' . ($customRequest->notes ?? '-'),
            ]);
        }

        $customRequest->update(['status' => $request->status]);
        
        $msg = 'Status request diperbarui';
        if ($request->status === 'diproses') {
            $msg = 'Custom request diterima! Tagihan pesanan menunggu pembayaran telah dikirim ke customer.';
        } elseif ($request->status === 'dibatalkan') {
            $msg = 'Custom request ditolak.';
        }

        return redirect()->back()->with('success', $msg);
    }
}
