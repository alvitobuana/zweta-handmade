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

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $data = $request->validate([
            'quantity' => 'required|integer',
            'min_stock' => 'required|integer',
        ]);

        $status = $data['quantity'] <= $data['min_stock'] ? 'habis' : 'aman';
        $material->update($data + ['status' => $status]);

        return redirect()->route('admin.materials.index')->with('success', 'Material updated');
    }
}
