<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class ProductionController extends Controller
{
    public function index()
    {
        $waiting = Order::where('status', 'pending')->get();
        $inProgress = Order::where('status', 'produksi')->get();
        $finishing = Order::where('status', 'finishing')->get();
        $ready = Order::where('status', 'siap_dikirim')->get();
        $completed = Order::where('status', 'selesai')->get();
        
        return view('admin.production_queue', compact('waiting', 'inProgress', 'finishing', 'ready', 'completed'));
    }
}
