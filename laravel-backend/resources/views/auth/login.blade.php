<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Media Agency Elite</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#cb252d",
                        "primary-dark": "#a81f25",
                        "background-dark": "#201213",
                        "card-dark": "#2d1a1c",
                    },
                    fontFamily: {
                        "body": ["Public Sans", "sans-serif"],
                    }
                }
            }
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Public Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#201213] text-white font-body antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center size-16 bg-primary rounded-2xl text-white shadow-lg shadow-primary/20 mb-4">
                    <span class="material-symbols-outlined text-4xl">campaign</span>
                </div>
                <h1 class="text-3xl font-black text-white mb-2">Vertex Media</h1>
                <p class="text-gray-400">Admin Dashboard</p>
            </div>
            
            <!-- Login Form -->
            <div class="bg-card-dark border border-white/5 rounded-2xl p-8 shadow-2xl">
                <h2 class="text-2xl font-bold text-white mb-6">Sign In</h2>
                
                @if($errors->any())
                    <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autofocus
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="admin@example.com"
                        >
                    </div>
                    
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                            placeholder="••••••••"
                        >
                    </div>
                    
                    <div class="mb-6 flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                class="rounded bg-white/5 border-white/10 text-primary focus:ring-primary"
                            >
                            <span class="ml-2 text-sm text-gray-400">Remember me</span>
                        </label>
                        
                        <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium">
                            Forgot password?
                        </a>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-lg shadow-lg shadow-primary/20 transition-all hover:-translate-y-0.5"
                    >
                        Sign In
                    </button>
                </form>
                
                <div class="mt-6 pt-6 border-t border-white/10">
                    <p class="text-center text-sm text-gray-400">
                        Default credentials: <span class="text-primary font-medium">admin@example.com</span> / <span class="text-primary font-medium">password</span>
                    </p>
                </div>
            </div>
            
            <p class="text-center text-sm text-gray-500 mt-6">
                &copy; {{ date('Y') }} Vertex Media Group. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
