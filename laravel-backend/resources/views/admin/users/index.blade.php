@extends('layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')
@section('page-description', 'Manage all users in the system')

@section('content')
<div class="space-y-6">
    <!-- Header Actions -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-white">All Users</h2>
            <p class="text-gray-400 mt-1">{{ $users->total() }} total users</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-6 py-3 rounded-lg shadow-lg shadow-primary/20 transition-all">
            <span class="material-symbols-outlined">add</span>
            Add New User
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="bg-card-dark border border-white/5 rounded-xl p-6">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search by name or email..." 
                class="flex-1 bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-primary"
            >
            <select 
                name="role" 
                class="bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-primary"
            >
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
            </select>
            <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold px-6 py-2 rounded-lg transition-all">
                Filter
            </button>
            @if(request()->has('search') || request()->has('role'))
            <a href="{{ route('admin.users.index') }}" class="border border-white/20 hover:border-white text-white font-bold px-6 py-2 rounded-lg transition-all">
                Clear
            </a>
            @endif
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-card-dark border border-white/5 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">User</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Email</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Role</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Status</th>
                        <th class="text-left py-4 px-6 text-sm font-bold text-gray-400 uppercase">Created</th>
                        <th class="text-right py-4 px-6 text-sm font-bold text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="size-10 rounded-full bg-primary flex items-center justify-center text-white">
                                    <span class="material-symbols-outlined">person</span>
                                </div>
                                <div>
                                    <p class="font-medium text-white">{{ $user->name }}</p>
                                    @if($user->phone)
                                    <p class="text-xs text-gray-500">{{ $user->phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-gray-300">{{ $user->email }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->role === 'admin' ? 'bg-primary/20 text-primary' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $user->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-sm text-gray-400">{{ $user->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white transition-colors" title="View">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 rounded-lg bg-white/5 hover:bg-primary/20 hover:text-primary transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
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
                            <span class="material-symbols-outlined text-6xl text-gray-600 mb-4">people</span>
                            <p class="text-gray-400">No users found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="border-t border-white/10 px-6 py-4">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
