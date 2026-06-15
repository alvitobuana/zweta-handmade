<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        $featured = $products->take(4);
        return view('home', compact('products','featured'));
    }

    public function katalog()
    {
        $products = Product::orderBy('name')->get();
        return view('katalog', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product', compact('product'));
    }
}
