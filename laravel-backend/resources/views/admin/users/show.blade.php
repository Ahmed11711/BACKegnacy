@extends('layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details: ' . $user->name)
@section('page-description', 'View user information and activity')

@section('content')
<div class="space-y-6">
    <!-- User Info Card -->
    <div class="bg-card-dark border border-white/5 rounded-xl p-8">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center gap-4">
                <div class="size-20 rounded-full bg-primary flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-4xl">person</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                    Edit User
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-400 mb-1">Role</p>
                <p class="text-white font-medium">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->role === 'admin' ? 'bg-primary/20 text-primary' : 'bg-gray-500/20 text-gray-400' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Status</p>
                <p class="text-white font-medium">
                    <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>
            @if($user->phone)
            <div>
                <p class="text-sm text-gray-400 mb-1">Phone</p>
                <p class="text-white font-medium">{{ $user->phone }}</p>
            </div>
            @endif
            <div>
                <p class="text-sm text-gray-400 mb-1">Email Verified</p>
                <p class="text-white font-medium">
                    {{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'Not verified' }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Member Since</p>
                <p class="text-white font-medium">{{ $user->created_at->format('M d, Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-400 mb-1">Last Updated</p>
                <p class="text-white font-medium">{{ $user->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    @if($user->orders)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-card-dark border border-white/5 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-white mb-1">{{ $user->orders->count() }}</h3>
            <p class="text-sm text-gray-400">Total Orders</p>
        </div>
    </div>
    @endif
</div>
@endsection
