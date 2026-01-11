@extends('layouts.app')

@section('title', 'Services Management')
@section('page-title', 'Services Management')
@section('page-description', 'Manage all services in the system')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">All Services</h2>
            <p class="text-gray-400 mt-1">{{ $services->total() }} total services</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add New Service
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="bg-card-dark border border-white/5 rounded-xl p-6">
        <form method="GET" action="{{ route('admin.services.index') }}" class="flex flex-col md:flex-row gap-4">
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
            @if(request()->has('category_id') || request()->has('is_active'))
            <a href="{{ route('admin.services.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-6 py-2 rounded-lg transition-all">
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Services Table -->
    <div class="bg-card-dark border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Service</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Category</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Price</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="text-right py-4 px-6 text-sm font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($service->icon)
                                <span class="material-symbols-outlined text-3xl text-primary">{{ $service->icon }}</span>
                                @else
                                <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined">handyman</span>
                                </div>
                                @endif
                                <div>
                                    <p class="font-medium text-white">{{ $service->name }}</p>
                                    @if($service->short_description)
                                    <p class="text-xs text-gray-500 line-clamp-1">{{ $service->short_description }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-gray-300">{{ $service->category->name ?? '-' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            @if($service->price)
                            <span class="text-white font-bold">${{ number_format($service->price, 2) }}</span>
                            @else
                            <span class="text-gray-500">N/A</span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $service->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.show', $service->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="View">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-primary/20 hover:text-primary transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline">
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
                        <td colspan="5" class="py-12 text-center">
                            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">handyman</span>
                            <p class="text-gray-400">No services found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($services->hasPages())
        <div class="border-t border-white/10 px-6 py-4">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
