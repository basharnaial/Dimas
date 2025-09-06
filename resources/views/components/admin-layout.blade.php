<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - لوحة التحكم</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-gray-50 to-slate-100" style="font-family: 'Cairo', sans-serif;">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-sm border-b border-gray-200 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 space-x-reverse hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('storage/products/logo-dimas.svg') }}" 
                                     alt="Demas Logo" 
                                     class="h-12 w-12 object-contain drop-shadow-md" />
                                <div class="text-right">
                                    <h1 class="text-xl font-bold text-gray-800 leading-tight">ديماس</h1>
                                    <p class="text-xs text-gray-500 font-medium">لوحة التحكم</p>
                                </div>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-6 sm:-my-px sm:mr-12 sm:flex">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-3 py-2 border-b-3 {{ request()->routeIs('admin.dashboard') ? 'border-slate-500 text-slate-700 bg-slate-50' : 'border-transparent text-gray-600 hover:text-slate-700 hover:border-slate-300 hover:bg-slate-50' }} text-sm font-semibold rounded-t-lg transition-all duration-200">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v0"></path>
                                </svg>
                                لوحة التحكم
                            </a>
                            <a href="{{ route('admin.products.index') }}" 
                               class="inline-flex items-center px-3 py-2 border-b-3 {{ request()->routeIs('admin.products.*') ? 'border-gray-500 text-gray-700 bg-gray-50' : 'border-transparent text-gray-600 hover:text-gray-700 hover:border-gray-300 hover:bg-gray-50' }} text-sm font-semibold rounded-t-lg transition-all duration-200">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                المنتجات
                            </a>
                            <a href="{{ route('admin.categories.index') }}" 
                               class="inline-flex items-center px-3 py-2 border-b-3 {{ request()->routeIs('admin.categories.*') ? 'border-stone-500 text-stone-700 bg-stone-50' : 'border-transparent text-gray-600 hover:text-stone-700 hover:border-stone-300 hover:bg-stone-50' }} text-sm font-semibold rounded-t-lg transition-all duration-200">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                الفئات
                            </a>
                            <a href="{{ route('admin.contacts.index') }}" 
                               class="inline-flex items-center px-3 py-2 border-b-3 {{ request()->routeIs('admin.contacts.*') ? 'border-zinc-500 text-zinc-700 bg-zinc-50' : 'border-transparent text-gray-600 hover:text-zinc-700 hover:border-zinc-300 hover:bg-zinc-50' }} text-sm font-semibold rounded-t-lg transition-all duration-200">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                الرسائل
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:mr-6">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <!-- User Info -->
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">مدير النظام</p>
                            </div>
                            
                            <!-- User Avatar & Logout -->
                            <div class="relative">
                                <button type="button" class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-slate-500 to-gray-600 rounded-full text-white font-bold text-sm hover:scale-105 focus:outline-none focus:ring-4 focus:ring-slate-300 transition-all duration-200 shadow-md" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </button>
                            </div>
                            
                            <!-- Quick Logout Button -->
                            <button onclick="if(confirm('هل تريد تسجيل الخروج؟')) document.getElementById('logout-form').submit();" class="flex items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-all duration-200">
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                خروج
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white/80 backdrop-blur-sm shadow-md border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h2 class="font-bold text-2xl text-gray-800 flex items-center">
                            <div class="w-1 h-8 bg-gradient-to-b from-slate-400 to-gray-500 rounded-full ml-3"></div>
                            {{ $header }}
                        </h2>
                        <div class="text-sm text-gray-500">
                            {{ now()->format('Y/m/d - H:i') }}
                        </div>
                    </div>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="pb-16">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-xl shadow-lg backdrop-blur-sm" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-xl shadow-lg backdrop-blur-sm" role="alert">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-600 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Logout Form -->
    <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
        @csrf
    </form>

    <script>
        // Enhanced user interaction
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide flash messages after 5 seconds
            const flashMessages = document.querySelectorAll('[role="alert"]');
            flashMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = 'all 0.5s ease-out';
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-20px)';
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 5000);
            });

            // User avatar hover effect
            const userButton = document.getElementById('user-menu-button');
            if (userButton) {
                userButton.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) rotate(5deg)';
                });
                userButton.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            }
        });
    </script>
</body>
</html>