<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            // Admin dashboard stats
            $stats = [
                'total_users' => \App\Models\User::count(),
                'active_users' => \App\Models\User::where('is_active', true)->count(),
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'total_products' => \App\Models\Product::count(),
                'active_products' => \App\Models\Product::where('is_active', true)->count(),
                'total_categories' => \App\Models\Category::count(),
                'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            ];
            
            $recentOrders = Order::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } else {
            // User dashboard stats
            $stats = [
                'my_orders' => Order::where('user_id', $user->id)->count(),
                'pending_orders' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
                'total_orders' => Order::where('user_id', $user->id)->count(),
            ];
            
            $recentOrders = Order::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        }
        
        return view('dashboard.index', compact('stats', 'recentOrders'));
    }
}
