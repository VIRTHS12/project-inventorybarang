@extends('layouts.app')

@section('title', 'Login - Inventory Barang')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">

            {{-- Sisi Kiri (Branding & Visual dengan Warna Baru) --}}
            <div class="relative hidden md:flex md:w-1/2">
                {{-- Background Gradient Baru & Konten Teks --}}
                <div
                    class="flex flex-col justify-between w-full h-full p-10 text-white bg-gradient-to-br from-teal-400 to-cyan-600 rounded-l-2xl">
                    <div class="text-left">
                        <a href="{{ route('login') }}" class="flex items-center space-x-3">
                            {{-- IKON BARU: Heroicon 'Archive Box' (SVG Inline) --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-10 h-10">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125V6.375c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v.001c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            <span class="text-2xl font-extrabold">InventoriKu</span>
                        </a>
                    </div>
                    <div class="text-left">
                        <p class="text-4xl font-bold leading-tight">Manajemen Stok Jadi Lebih Efisien.</p>
                        <p class="mt-4 text-cyan-100">
                            Akses dashboard Anda untuk mengelola produk, melacak inventaris, dan melihat laporan secara
                            real-time.
                        </p>
                    </div>
                    <div class="text-sm text-center text-cyan-200">
                        &copy; {{ date('Y') }} InventoriKu. All Rights Reserved.
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan (Form Login) --}}
            <div class="flex flex-col justify-center p-8 md:p-14 md:w-1/2">

                <div class="text-left mb-8">
                    <h2 class="text-4xl font-bold text-gray-900">Selamat Datang!</h2>
                    <p class="mt-2 text-gray-600">Silakan masuk untuk melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Input Email --}}
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                {{-- IKON BARU: Heroicon 'Envelope' (SVG Inline) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                                placeholder="contoh@email.com" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                {{-- IKON BARU: Heroicon 'Lock Closed' (SVG Inline) --}}
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 0 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Opsi Lanjutan --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">Ingat saya</label>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent text-base font-medium rounded-lg text-white bg-teal-500 hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transform hover:scale-105 transition-transform duration-150 ease-in-out">
                            Masuk
                        </button>
                    </div>

                    {{-- Info Akun Demo --}}
                    <div class="text-center pt-4 border-t border-gray-200">
                        <div class="bg-gray-100 text-gray-700 p-3 rounded-lg text-sm">
                            <p class="text-xs mt-1">Gunakan Akun Demo: <code
                                    class="bg-gray-200 px-1 rounded">admin@umam.com</code> / <code
                                    class="bg-gray-200 px-1 rounded">password123</code></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
