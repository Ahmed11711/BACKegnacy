<header class="bg-card-dark dark:bg-card-dark border-b border-white/10 dark:border-white/10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white">@yield('page-title', 'Dashboard')</h1>
            <p class="text-sm text-gray-400 mt-1">@yield('page-description', 'Welcome back, ' . auth()->user()->name)</p>
        </div>
        
        <div class="flex items-center gap-4">
            @if(auth()->user()->isAdmin())
            <span class="px-3 py-1 bg-primary/20 text-primary text-xs font-bold rounded-full uppercase tracking-wider">
                Admin
            </span>
            @endif
            
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" target="_blank" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 transition-colors" title="View Website">
                    <span class="material-symbols-outlined">open_in_new</span>
                </a>
            </div>
        </div>
    </div>
</header>
