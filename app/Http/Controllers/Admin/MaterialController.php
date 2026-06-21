<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('admin.materials', compact('materials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'type'      => 'required|string|max:255',
            'quantity'  => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'price'     => 'required|integer|min:0',
        ]);

        if ($data['quantity'] <= 0) {
            $status = 'habis';
        } elseif ($data['quantity'] <= $data['min_stock']) {
            $status = 'menipis';
        } else {
            $status = 'aman';
        }

        Material::create($data + ['status' => $status]);

        return redirect()->route('admin.materials.index')->with('success', 'Bahan berhasil ditambahkan!');
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $data = $request->validate([
            'name'      => 'sometimes|string|max:255',
            'type'      => 'sometimes|string|max:255',
            'quantity'  => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'price'     => 'required|integer|min:0',
        ]);

        if ($data['quantity'] <= 0) {
            $status = 'habis';
        } elseif ($data['quantity'] <= $data['min_stock']) {
            $status = 'menipis';
        } else {
            $status = 'aman';
        }

        $material->update($data + ['status' => $status]);

        return redirect()->route('admin.materials.index')->with('success', 'Bahan berhasil diperbarui!');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Bahan berhasil dihapus!');
    }
}
