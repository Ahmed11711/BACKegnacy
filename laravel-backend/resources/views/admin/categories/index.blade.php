@extends('layouts.app')

@section('title', 'Categories Management')
@section('page-title', 'Categories Management')
@section('page-description', 'Manage all categories in the system')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">All Categories</h2>
            <p class="text-gray-400 mt-1">{{ $categories->count() }} total categories</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add New Category
        </a>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
        <div class="bg-card-dark border border-white/5 rounded-xl p-6 hover:border-primary/50 transition-all">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-3">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="size-12 rounded-lg object-cover">
                    @else
                    <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">category</span>
                    </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-white">{{ $category->name }}</h3>
                        @if($category->parent)
                        <p class="text-xs text-gray-500">Parent: {{ $category->parent->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($category->description)
            <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ $category->description }}</p>
            @endif

            <div class="flex items-center justify-between pt-4 border-t border-white/10">
                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $category->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                </span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.categories.show', $category->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="View">
                        <span class="material-symbols-outlined text-lg">visibility</span>
                    </a>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-primary/20 hover:text-primary transition-colors" title="Edit">
                        <span class="material-symbols-outlined text-lg">edit</span>
                    </a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-400 transition-colors" title="Delete">
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-card-dark border border-white/5 rounded-xl p-12 text-center">
            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">category</span>
            <p class="text-gray-400">No categories found</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
