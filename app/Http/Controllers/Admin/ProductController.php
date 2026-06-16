<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = Product::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $products = $query->orderBy('id', 'desc')->paginate(12);
        return view('admin.products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:products,slug',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'status'      => 'nullable|in:ready,pre-order,custom',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category'    => 'nullable|string|max:255',
            'material'    => 'nullable|string|max:255',
            'size'        => 'nullable|string|max:255',
            'colors'      => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
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
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|unique:products,slug,' . $product->id,
            'price'       => 'required|numeric|min:0',
            'stock'       => 'nullable|integer|min:0',
            'status'      => 'nullable|in:ready,pre-order,custom',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category'    => 'nullable|string|max:255',
            'material'    => 'nullable|string|max:255',
            'size'        => 'nullable|string|max:255',
            'colors'      => 'nullable|string|max:255',
        ]);

        if ($request->remove_image == '1') {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar dari storage bila ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}

