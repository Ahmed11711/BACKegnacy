@extends('layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details: ' . $category->name)
@section('page-description', 'View category information')

@section('content')
<div class="space-y-6">
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="size-24 rounded-xl object-cover">
                @else
                <div class="size-24 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-5xl">category</span>
                </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $category->name }}</h2>
                    @if($category->parent)
                    <p class="text-gray-400">Parent: {{ $category->parent->name }}</p>
                    @else
                    <p class="text-gray-400">Top Level Category</p>
                    @endif
                </div>
            </div>
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                Edit Category
            </a>
        </div>

        @if($category->description)
        <div class="mb-6">
            <p class="text-sm text-gray-400 mb-2">Description</p>
            <p class="text-gray-300 leading-relaxed">{{ $category->description }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6 border-t border-white/10">
            <div>
                <p class="text-sm text-gray-400 mb-1">Status</p>
                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $category->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Order</p>
                <p class="text-white font-medium">{{ $category->order }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Created</p>
                <p class="text-white font-medium">{{ $category->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
