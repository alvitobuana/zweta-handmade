<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomRequest;

class CustomRequestController extends Controller
{
    public function create()
    {
        $materials = \App\Models\Material::all();
        return view('custom', compact('materials'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'model' => 'required|string',
            'color' => 'required|string',
            'notes' => 'nullable|string',
            'deadline' => 'nullable|date',
            'reference_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('reference_image')) {
            $imageName = time().'_reference_'.uniqid().'.'.$request->reference_image->extension();
            $request->reference_image->move(public_path('uploads/custom_references'), $imageName);
            $data['reference_image'] = 'uploads/custom_references/' . $imageName;
        }

        $user = auth()->user();

        // Generate unique tracking code checking both tables
        do {
            $code = 'ZW-CST-' . strtoupper(\Illuminate\Support\Str::random(5));
        } while (
            \App\Models\Order::where('code', $code)->exists() || 
            \App\Models\CustomRequest::where('code', $code)->exists()
        );

        $basePrices = [
            'Sling Bag' => 125000,
            'Backpack' => 250000,
            'Totebag' => 150000
        ];
        
        $basePrice = $basePrices[$data['model']] ?? 0;
        $materialsPrice = 0;

        if ($request->has('materials') && is_array($request->materials)) {
            $materialsPrice = \App\Models\Material::whereIn('id', $request->materials)->sum('price');
        }
        
        $estimatedPrice = $basePrice + $materialsPrice;

        $customData = array_merge($data, [
            'code' => $code,
            'customer_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->whatsapp ?? '-',
            'status' => 'menunggu',
            'estimated_price' => $estimatedPrice,
        ]);

        $customRequest = CustomRequest::create($customData);

        if ($request->has('materials') && is_array($request->materials)) {
            // Attach materials with default qty of 1 for simplicity
            $materialsWithQty = [];
            foreach ($request->materials as $materialId) {
                $materialsWithQty[$materialId] = ['qty' => 1];
            }
            $customRequest->materials()->sync($materialsWithQty);
        }

        return redirect()->route('tracking', ['code' => $code])->with('success', 'Request custom berhasil dikirim! Silakan pantau status persetujuan admin di bawah.');
    }
}
