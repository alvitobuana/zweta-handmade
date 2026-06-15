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
            'customer_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'model' => 'required|string',
            'color' => 'required|string',
            'notes' => 'nullable|string',
            'deadline' => 'nullable|date'
        ]);

        CustomRequest::create($data + ['status' => 'menunggu']);
        return redirect()->route('tracking')->with('success', 'Custom request submitted!');
    }
}
