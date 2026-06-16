<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\CustomRequest;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomRequests = CustomRequest::count();
        $totalCustomers = Customer::count();
        $totalRevenue = Order::sum('price');
        
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $requestsByStatus = CustomRequest::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $recentOrders = Order::latest()->limit(5)->get();
        $recentRequests = CustomRequest::latest()->limit(5)->get();
        
        $pendingCount = Order::where('status', 'pending')->count();
        $deadlineCount = Order::where('status', 'produksi')->count();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomRequests',
            'totalCustomers',
            'totalRevenue',
            'ordersByStatus',
            'requestsByStatus',
            'recentOrders',
            'recentRequests',
            'pendingCount',
            'deadlineCount'
        ));
    }
}
