@extends('layouts.app')

@section('title', 'Products Management')
@section('page-title', 'Products Management')
@section('page-description', 'Manage all products in the system')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">All Products</h2>
            <p class="text-gray-400 mt-1">{{ $products->total() }} total products</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add New Product
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="bg-card-dark border border-white/5 rounded-xl p-6">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search products..." 
                class="flex-1 bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-primary"
            >
            <select 
                name="category_id" 
                class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary"
            >
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <select 
                name="is_active" 
                class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary"
            >
                <option value="">All Status</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                Filter
            </button>
            @if(request()->has('search') || request()->has('category_id') || request()->has('is_active'))
            <a href="{{ route('admin.products.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-6 py-2 rounded-lg transition-all">
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-card-dark border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Product</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Category</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Price</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Stock</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="text-right py-4 px-6 text-sm font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="size-12 rounded-lg object-cover">
                                @else
                                <div class="size-12 rounded-lg bg-white/5 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-gray-600">image</span>
                                </div>
                                @endif
                                <div>
                                    <p class="font-medium text-white">{{ $product->name }}</p>
                                    @if($product->sku)
                                    <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-gray-300">{{ $product->category->name ?? '-' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col">
                                @if($product->sale_price)
                                <span class="text-white font-bold">${{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-gray-500 text-xs line-through">${{ number_format($product->price, 2) }}</span>
                                @else
                                <span class="text-white font-bold">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-gray-300">{{ $product->stock_quantity }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $product->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="View">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-primary/20 hover:text-primary transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-400 transition-colors" title="Delete">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">inventory</span>
                            <p class="text-gray-400">No products found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="border-t border-white/10 px-6 py-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
