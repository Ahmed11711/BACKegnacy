<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            $orders = Order::with('user')->latest()->paginate(15);
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->paginate(15);
        }
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order.
     */
    public function store(Request $request)
    {
        // Implementation for storing orders
        // This will be handled by your order service
        return redirect()->route('web.orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified order.
     */
    public function show(Request $request, Order $order)
    {
        if (!$request->user()->isAdmin() && $order->user_id !== $request->user()->id) {
            abort(403);
        }
        
        $order->load('items.orderable', 'user', 'payments');
        
        return view('orders.show', compact('order'));
    }
}
