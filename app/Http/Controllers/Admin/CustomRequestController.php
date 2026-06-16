<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomRequest;

class CustomRequestController extends Controller
{
    public function index()
    {
        $requests = CustomRequest::latest()->paginate(15);
        return view('admin.custom_requests', compact('requests'));
    }

    public function show($id)
    {
        $req = CustomRequest::findOrFail($id);
        return view('admin.custom_request_show', compact('req'));
    }

    public function updateStatus(Request $request, CustomRequest $customRequest)
    {
        $request->validate([
            'status' => ['required', 'in:menunggu,diproses,selesai,dibatalkan'],
        ]);

        $customRequest->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status request diperbarui');
    }
}
