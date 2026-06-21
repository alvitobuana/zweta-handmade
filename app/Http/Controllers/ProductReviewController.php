<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductReviewController extends Controller
{
    public function store(Request $request, $orderCode)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,mp4,mov|max:10240', // 10MB
        ]);

        $order = Order::where('code', $orderCode)->firstOrFail();

        if ($order->status !== 'selesai') {
            return back()->with('error', 'Hanya pesanan yang sudah selesai yang bisa diulas.');
        }

        $existing = ProductReview::where('order_code', $orderCode)->first();
        if ($existing) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        $product = Product::where('name', $order->product)->first();
        
        if (!$product) {
            return back()->with('error', 'Produk tidak ditemukan di katalog (mungkin ini pesanan custom).');
        }

        $mediaPath = null;
        $mediaType = null;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $mediaPath = $file->store('reviews', 'public');
            
            $extension = strtolower($file->getClientOriginalExtension());
            if (in_array($extension, ['mp4', 'mov'])) {
                $mediaType = 'video';
            } else {
                $mediaType = 'image';
            }
        }

        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_code' => $orderCode,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'media_path' => $mediaPath ? 'storage/' . $mediaPath : null,
            'media_type' => $mediaType,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim. Terima kasih atas feedback Anda!');
    }
}
