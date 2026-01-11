<aside class="w-64 bg-card-dark dark:bg-card-dark border-r border-white/10 dark:border-white/10 flex flex-col">
    <!-- Logo -->
    <div class="p-6 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="size-10 bg-primary rounded-lg flex items-center justify-center text-white shadow-lg shadow-primary/20 transition-transform group-hover:scale-110">
                <span class="material-symbols-outlined text-2xl">campaign</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-bold tracking-tight text-white uppercase leading-none">Vertex</span>
                <span class="text-[10px] tracking-[0.2em] text-gray-400 uppercase font-medium">Media Group</span>
            </div>
        </a>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto p-4 space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('dashboard') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-medium">Dashboard</span>
        </a>
        
        @if(auth()->user()->isAdmin())
        <div class="pt-4">
            <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Management</p>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">people</span>
                <span class="font-medium">Users</span>
            </a>
            
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">inventory</span>
                <span class="font-medium">Products</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">category</span>
                <span class="font-medium">Categories</span>
            </a>
            
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">handyman</span>
                <span class="font-medium">Services</span>
            </a>
            
            <a href="{{ route('admin.bundles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.bundles.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">package</span>
                <span class="font-medium">Bundles</span>
            </a>
        </div>
        @endif
        
        <div class="pt-4">
            <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Content</p>
            
            <a href="{{ route('web.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('web.orders.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span class="font-medium">Orders</span>
            </a>
            
            <a href="{{ route('web.payments.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('web.payments.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">payment</span>
                <span class="font-medium">Payments</span>
            </a>
        </div>
        
        @if(auth()->user()->isAdmin())
        <div class="pt-4">
            <p class="px-4 text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">System</p>
            
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-medium">Settings</span>
            </a>
            
            <a href="{{ route('admin.activity-logs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors {{ request()->routeIs('admin.activity-logs.*') ? 'bg-primary/20 text-primary border-l-2 border-primary' : '' }}">
                <span class="material-symbols-outlined">history</span>
                <span class="font-medium">Activity Logs</span>
            </a>
        </div>
        @endif
    </nav>
    
    <!-- User Section -->
    <div class="p-4 border-t border-white/10">
        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white/5">
            <div class="size-10 rounded-full bg-primary flex items-center justify-center text-white">
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                <span class="material-symbols-outlined text-lg">logout</span>
                <span class="font-medium text-sm">Logout</span>
            </button>
        </form>
    </div>
</aside>
