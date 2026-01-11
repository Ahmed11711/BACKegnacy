@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your account')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users (Admin only) -->
        @if(auth()->user()->isAdmin())
        <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">people</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ $stats['total_users'] ?? 0 }}</h3>
            <p class="text-sm text-gray-400">Total Users</p>
        </div>
        
        <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">inventory</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ $stats['total_products'] ?? 0 }}</h3>
            <p class="text-sm text-gray-400">Total Products</p>
        </div>
        @endif
        
        <!-- Orders -->
        <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ $stats['total_orders'] ?? 0 }}</h3>
            <p class="text-sm text-gray-400">Total Orders</p>
            @if(auth()->user()->isAdmin() && isset($stats['pending_orders']))
            <p class="text-xs text-primary mt-1">{{ $stats['pending_orders'] }} pending</p>
            @endif
        </div>
        
        <!-- Revenue (if admin) -->
        @if(auth()->user()->isAdmin())
        <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">trending_up</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ number_format($stats['total_revenue'] ?? 0, 2) }}</h3>
            <p class="text-sm text-gray-400">Total Revenue</p>
        </div>
        @else
        <!-- Active Products (User view) -->
        <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">check_circle</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ $stats['my_orders'] ?? 0 }}</h3>
            <p class="text-sm text-gray-400">My Orders</p>
        </div>
        @endif
    </div>
    
    <!-- Recent Orders -->
    <div class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white">Recent Orders</h2>
            <a href="{{ route('web.orders.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium flex items-center gap-1">
                View All <span class="material-symbols-outlined text-lg">arrow_forward</span>
            </a>
        </div>
        
        @if($recentOrders && $recentOrders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-400 uppercase">Order Number</th>
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-400 uppercase">Total</th>
                        <th class="text-left py-3 px-4 text-sm font-bold text-gray-400 uppercase">Date</th>
                        <th class="text-right py-3 px-4 text-sm font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-4 px-4">
                            <span class="font-medium text-white">#{{ $order->order_number }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="px-2 py-1 text-xs font-bold rounded-full 
                                {{ $order->status === 'delivered' ? 'bg-green-500/20 text-green-400' : '' }}
                                {{ $order->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : '' }}
                                {{ $order->status === 'processing' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                {{ $order->status === 'cancelled' ? 'bg-red-500/20 text-red-400' : '' }}
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-bold text-white">${{ number_format($order->total, 2) }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="text-gray-400 text-sm">{{ $order->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <a href="{{ route('web.orders.show', $order->id) }}" class="text-primary hover:text-primary-dark font-medium text-sm">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12">
            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">shopping_cart</span>
            <p class="text-gray-400">No orders yet</p>
        </div>
        @endif
    </div>
    
    @if(auth()->user()->isAdmin())
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.products.create') }}" class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all group">
            <div class="flex items-center gap-4">
                <div class="size-14 rounded-xl bg-primary/10 group-hover:bg-primary transition-colors flex items-center justify-center text-primary group-hover:text-white">
                    <span class="material-symbols-outlined text-3xl">add</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">Add Product</h3>
                    <p class="text-sm text-gray-400">Create a new product</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.categories.create') }}" class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all group">
            <div class="flex items-center gap-4">
                <div class="size-14 rounded-xl bg-primary/10 group-hover:bg-primary transition-colors flex items-center justify-center text-primary group-hover:text-white">
                    <span class="material-symbols-outlined text-3xl">category</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">Add Category</h3>
                    <p class="text-sm text-gray-400">Create a new category</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="bg-card-dark dark:bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all group">
            <div class="flex items-center gap-4">
                <div class="size-14 rounded-xl bg-primary/10 group-hover:bg-primary transition-colors flex items-center justify-center text-primary group-hover:text-white">
                    <span class="material-symbols-outlined text-3xl">people</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-white mb-1">Manage Users</h3>
                    <p class="text-sm text-gray-400">View all users</p>
                </div>
            </div>
        </a>
    </div>
    @endif
</div>
@endsection
