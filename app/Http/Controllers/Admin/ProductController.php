<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:products,slug',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);

        Product::create($data);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:products,slug,'.$product->id,
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'description' => 'nullable|string'
        ]);

        $product->update($data);
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return back();
    }
}
