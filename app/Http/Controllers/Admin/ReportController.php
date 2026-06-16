<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\CustomRequest;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $revenue = Order::sum('price') ?: 0;
        $transactions = Order::count();
        $customCount = CustomRequest::count();
        $productsSold = Order::sum('qty') ?: 0;

        // Fetch recent sales for listing
        $sales = Order::latest()->paginate(15);

        return view('admin.reports', compact(
            'revenue',
            'transactions',
            'customCount',
            'productsSold',
            'sales'
        ));
    }
}
