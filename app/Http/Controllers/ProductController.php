<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        $featured = $products->take(4);
        return view('home', compact('products','featured'));
    }

    public function katalog(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $sort = $request->query('sort');

        $query = Product::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($sort === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'price-low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price-high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('name', 'asc');
        }

        $products = $query->paginate(8)->withQueryString();

        return view('katalog', compact('products', 'search'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product', compact('product'));
    }

    public function order(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Stok produk habis!');
        }

        // Generate a unique tracking code
        do {
            $code = 'ORD-' . strtoupper(\Illuminate\Support\Str::random(6));
        } while (Order::where('code', $code)->exists());

        // Create Order
        Order::create([
            'code' => $code,
            'customer_name' => auth()->user()->name,
            'product' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'status' => 'pending',
            'notes' => 'Pemesanan langsung dari detail produk',
        ]);

        // Reduce stock
        $product->decrement('stock');

        return redirect()->route('tracking', ['code' => $code])->with('success', 'Pemesanan berhasil! Silakan lacak pesanan Anda di bawah.');
    }
}
