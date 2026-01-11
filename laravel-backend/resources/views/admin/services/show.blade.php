@extends('layouts.app')

@section('title', 'Service Details')
@section('page-title', 'Service Details: ' . $service->name)
@section('page-description', 'View service information')

@section('content')
<div class="space-y-6">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                @if($service->icon)
                <span class="material-symbols-outlined text-6xl text-primary">{{ $service->icon }}</span>
                @else
                <div class="size-20 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-5xl">handyman</span>
                </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $service->name }}</h2>
                    @if($service->category)
                    <p class="text-gray-400">Category: {{ $service->category->name }}</p>
                    @endif
                </div>
            </div>
            <a href="{{ route('admin.services.edit', $service->id) }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                Edit Service
            </a>
        </div>

        @if($service->description)
        <div class="mb-6">
            <p class="text-sm text-gray-400 mb-2">Description</p>
            <p class="text-gray-300 leading-relaxed">{{ $service->description }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-white/10">
            @if($service->price)
            <div>
                <p class="text-sm text-gray-400 mb-1">Price</p>
                <p class="text-white font-bold text-xl">${{ number_format($service->price, 2) }}</p>
            </div>
            @endif
            <div>
                <p class="text-sm text-gray-400 mb-1">Status</p>
                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $service->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Order</p>
                <p class="text-white font-medium">{{ $service->order }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
