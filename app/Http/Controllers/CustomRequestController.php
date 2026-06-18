<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomRequest;

class CustomRequestController extends Controller
{
    public function create()
    {
        return view('custom');
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
        $customData = array_merge($data, [
            'customer_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->whatsapp ?? '-',
            'status' => 'menunggu'
        ]);

        CustomRequest::create($customData);
        return redirect()->route('tracking')->with('success', 'Request custom berhasil dikirim!');
    }
}
