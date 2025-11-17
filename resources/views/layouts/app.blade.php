<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>

    {{-- DULU: @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    {{-- SEKARANG: Menggunakan CDN untuk Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
        @auth

<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
        <aside
            class="fixed inset-y-0 left-0 z-30 flex flex-col w-64 px-4 py-8 overflow-y-auto bg-slate-800 border-r rtl:border-r-0 rtl:border-l text-gray-300 transition-transform transform lg:translate-x-0"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">

            <a href="#" class="mx-auto">
                <span class="text-2xl font-bold text-white">INVENTORI</span>
            </a>

            <div class="flex flex-col justify-between flex-1 mt-10">
                <nav class="space-y-2">
                    <span class="px-4 text-sm font-semibold text-gray-400">MENU UTAMA</span>
                    <a class="flex items-center px-4 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : 'hover:bg-slate-700 hover:text-white' }}" href="{{ route('admin.dashboard') }}">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span class="mx-4 font-medium">Dashboard</span>
                    </a>
                    <a class="flex items-center px-4 py-2 mt-2 transition-colors duration-300 transform rounded-lg {{ request()->routeIs('admin.barang.*') ? 'bg-slate-700 text-white' : 'hover:bg-slate-700 hover:text-white' }}" href="{{ route('admin.barang.index') }}">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        <span class="mx-4 font-medium">Data Barang</span>
                    </a>
                    </nav>

                <div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 mt-5 text-white bg-red-500 rounded-lg hover:bg-red-600">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            <span class="mx-4 font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden lg:ml-64">            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-2 border-gray-200 shadow-sm">

                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>

                <div class="flex items-center">
        {{-- Kode ini hanya akan dijalankan JIKA user sudah login, sehingga 100% aman dari error '... on null' --}}
            <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="block">
                <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=slate&color=fff" alt="User avatar">
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                <div class="px-4 py-3 text-sm text-gray-900 border-b">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="font-medium truncate text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    @endauth

    {{-- Jika user belum login, bagian ini tidak akan dirender sama sekali --}}
</div>            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
