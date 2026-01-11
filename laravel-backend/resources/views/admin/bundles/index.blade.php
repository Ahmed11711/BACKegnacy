@extends('layouts.app')

@section('title', 'Bundles Management')
@section('page-title', 'Bundles Management')
@section('page-description', 'Manage all bundles in the system')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">All Bundles</h2>
            <p class="text-gray-400 mt-1">{{ $bundles->total() }} total bundles</p>
        </div>
        <a href="{{ route('admin.bundles.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add New Bundle
        </a>
    </div>

    <!-- Bundles Table -->
    <div class="bg-card-dark border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Bundle</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Products</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Price</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="text-right py-4 px-6 text-sm font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bundles as $bundle)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                @if($bundle->image)
                                <img src="{{ asset('storage/' . $bundle->image) }}" alt="{{ $bundle->name }}" class="size-12 rounded-lg object-cover">
                                @else
                                <div class="size-12 rounded-lg bg-white/5 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-gray-600">package</span>
                                </div>
                                @endif
                                <div>
                                    <p class="font-medium text-white">{{ $bundle->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-gray-300">{{ $bundle->products->count() }} products</p>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col">
                                @if($bundle->sale_price)
                                <span class="text-white font-bold">${{ number_format($bundle->sale_price, 2) }}</span>
                                <span class="text-gray-500 text-xs line-through">${{ number_format($bundle->price, 2) }}</span>
                                @else
                                <span class="text-white font-bold">${{ number_format($bundle->price, 2) }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $bundle->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $bundle->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.bundles.show', $bundle->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="View">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <a href="{{ route('admin.bundles.edit', $bundle->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-primary/20 hover:text-primary transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.bundles.destroy', $bundle->id) }}" onsubmit="return confirm('Are you sure you want to delete this bundle?');" class="inline">
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
                            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">package</span>
                            <p class="text-gray-400">No bundles found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($bundles->hasPages())
        <div class="border-t border-white/10 px-6 py-4">
            {{ $bundles->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
