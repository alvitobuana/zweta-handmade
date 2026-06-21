<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        $featured = $products->take(4);

        // --- AI Recommendation: Score each product based on data signals ---
        // Score = (total_orders × 2) + (avg_rating × 10) + (stock_bonus: 5 if stock > 0)
        $aiRecommended = Product::with('reviews')
            ->get()
            ->map(function ($product) {
                // Count completed/in-progress orders matching this product name
                $orderCount = Order::where('product', 'like', "%{$product->name}%")->count();

                // Average review rating (0 if no reviews)
                $avgRating = $product->reviews->avg('rating') ?? 0;

                // Stock bonus
                $stockBonus = $product->stock > 0 ? 5 : 0;

                // Compute AI score
                $product->ai_score    = ($orderCount * 2) + ($avgRating * 10) + $stockBonus;
                $product->order_count = $orderCount;
                $product->avg_rating  = round($avgRating, 1);

                return $product;
            })
            ->sortByDesc('ai_score')
            ->take(4)
            ->values();

        return view('home', compact('products', 'featured', 'aiRecommended'));
    }

    public function katalog(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $category = $request->query('category');
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

        if ($category) {
            $query->where('category', $category);
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
        $product = Product::with('reviews.user')->where('slug', $slug)->firstOrFail();
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

        $paymentMethod = $request->input('payment_method', 'transfer');
        $initialStatus = $paymentMethod === 'cod' ? 'produksi' : 'pending';

        // Create Order
        Order::create([
            'code' => $code,
            'customer_name' => auth()->user()->name,
            'product' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'status' => $initialStatus,
            'payment_method' => $paymentMethod,
            'notes' => 'Pemesanan langsung dari detail produk',
        ]);

        // Reduce stock
        $product->decrement('stock');

        return redirect()->route('tracking', ['code' => $code])->with('success', 'Pemesanan berhasil! Silakan lacak pesanan Anda di bawah.');
    }
}
