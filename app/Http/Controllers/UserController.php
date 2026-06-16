<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('pages.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pages.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->only(['name', 'email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect('/profile')->with('success', 'Profile berhasil diperbarui');
    }
}
