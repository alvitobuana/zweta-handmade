<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        
        $latestOrder = Order::where('customer_name', $user->name)->latest()->first();
        $latestRequest = \App\Models\CustomRequest::where('customer_name', $user->name)->latest()->first();
        
        $latestActivity = null;
        if ($latestOrder && $latestRequest) {
            $latestActivity = ($latestOrder->created_at >= $latestRequest->created_at) ? $latestOrder : $latestRequest;
        } else {
            $latestActivity = $latestOrder ?? $latestRequest;
        }

        if ($latestActivity && $latestActivity instanceof \App\Models\CustomRequest) {
            $latestActivity->is_custom_request = true;
            $latestActivity->product = ($latestActivity->model ?? 'Custom') . ' Custom (Request)';
        }

        return view('pages.profile', compact('user', 'latestActivity'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pages.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'whatsapp'  => 'nullable|string|max:20',
            'address'   => 'nullable|string|max:500',
            'password'  => 'nullable|string|min:8|confirmed',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect('/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
