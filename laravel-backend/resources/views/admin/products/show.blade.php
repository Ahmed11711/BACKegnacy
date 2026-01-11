@extends('layouts.app')

@section('title', 'Product Details')
@section('page-title', 'Product Details: ' . $product->name)
@section('page-description', 'View product information')

@section('content')
<div class="space-y-6">
    <!-- Product Info Card -->
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                @if($product->images && count($product->images) > 0)
                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}" class="size-24 rounded-xl object-cover">
                @else
                <div class="size-24 rounded-xl bg-white/5 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-gray-600">image</span>
                </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $product->name }}</h2>
                    @if($product->sku)
                    <p class="text-gray-400">SKU: {{ $product->sku }}</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                    Edit Product
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-400 mb-1">Price</p>
                <div class="flex flex-col">
                    @if($product->sale_price)
                    <span class="text-white font-bold text-xl">${{ number_format($product->sale_price, 2) }}</span>
                    <span class="text-gray-500 text-sm line-through">${{ number_format($product->price, 2) }}</span>
                    @else
                    <span class="text-white font-bold text-xl">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Stock Quantity</p>
                <p class="text-white font-medium text-xl">{{ $product->stock_quantity }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Stock Status</p>
                <p class="text-white font-medium text-xl capitalize">{{ str_replace('_', ' ', $product->stock_status) }}</p>
            </div>
        </div>

        @if($product->description)
        <div class="mb-6">
            <p class="text-sm text-gray-400 mb-2">Description</p>
            <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
        </div>
        @endif

        @if($product->short_description)
        <div class="mb-6">
            <p class="text-sm text-gray-400 mb-2">Short Description</p>
            <p class="text-gray-300">{{ $product->short_description }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-white/10">
            <div>
                <p class="text-sm text-gray-400 mb-1">Category</p>
                <p class="text-white font-medium">{{ $product->category->name ?? 'No Category' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Status</p>
                <p class="text-white font-medium">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $product->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Featured</p>
                <p class="text-white font-medium">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $product->is_featured ? 'bg-primary/20 text-primary' : 'bg-gray-500/20 text-gray-400' }}">
                        {{ $product->is_featured ? 'Yes' : 'No' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Views</p>
                <p class="text-white font-medium">{{ $product->views }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Created</p>
                <p class="text-white font-medium">{{ $product->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Updated</p>
                <p class="text-white font-medium">{{ $product->updated_at->format('M d, Y') }}</p>
            </div>
        </div>

        @if($product->images && count($product->images) > 0)
        <div class="pt-6 border-t border-white/10">
            <p class="text-sm text-gray-400 mb-4">Product Images</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($product->images as $image)
                <img src="{{ asset('storage/' . $image) }}" alt="Product image" class="w-full aspect-square rounded-lg object-cover">
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
