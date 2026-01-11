@extends('layouts.app')

@section('title', 'Bundle Details')
@section('page-title', 'Bundle Details: ' . $bundle->name)
@section('page-description', 'View bundle information')

@section('content')
<div class="space-y-6">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                @if($bundle->image)
                <img src="{{ asset('storage/' . $bundle->image) }}" alt="{{ $bundle->name }}" class="size-24 rounded-xl object-cover">
                @else
                <div class="size-24 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-5xl">package</span>
                </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $bundle->name }}</h2>
                </div>
            </div>
            <a href="{{ route('admin.bundles.edit', $bundle->id) }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                Edit Bundle
            </a>
        </div>

        @if($bundle->description)
        <div class="mb-6">
            <p class="text-sm text-gray-400 mb-2">Description</p>
            <p class="text-gray-300 leading-relaxed">{{ $bundle->description }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-400 mb-1">Price</p>
                <div class="flex flex-col">
                    @if($bundle->sale_price)
                    <span class="text-white font-bold text-xl">${{ number_format($bundle->sale_price, 2) }}</span>
                    <span class="text-gray-500 text-sm line-through">${{ number_format($bundle->price, 2) }}</span>
                    @else
                    <span class="text-white font-bold text-xl">${{ number_format($bundle->price, 2) }}</span>
                    @endif
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Products</p>
                <p class="text-white font-medium text-xl">{{ $bundle->products->count() }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Status</p>
                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $bundle->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ $bundle->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        @if($bundle->products->count() > 0)
        <div class="pt-6 border-t border-white/10">
            <p class="text-sm font-medium text-gray-400 mb-4">Products in Bundle</p>
            <div class="space-y-3">
                @foreach($bundle->products as $product)
                <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg">
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
                            <p class="text-sm text-gray-500">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 bg-primary/20 text-primary text-sm font-bold rounded-full">
                        Qty: {{ $product->pivot->quantity }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
