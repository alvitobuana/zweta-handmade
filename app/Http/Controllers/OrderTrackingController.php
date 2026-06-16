<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderTrackingController extends Controller
{
    public function index()
    {
        return view('tracking');
    }

    public function search(Request $request)
    {
        $code = $request->query('code');
        $order = null;
        
        if ($code) {
            $order = Order::where('code', $code)->first();
        }
        
        return view('tracking', compact('order', 'code'));
    }
}
