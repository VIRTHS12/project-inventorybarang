@extends('layouts.app')

@section('title', 'Detail Barang - ' . $barang->nama_barang)

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.barang.index') }}" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-arrow-left text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $barang->nama_barang }}</h1>
                        <p class="mt-2 text-gray-600">Kode: {{ $barang->kode_barang }}</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.barang.edit', $barang->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Barang
                    </a>
                    <form method="POST" action="{{ route('admin.barang.destroy', $barang->id) }}" class="inline"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Informasi Barang</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nama Barang</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $barang->nama_barang }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Kode Barang</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $barang->kode_barang }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                <dd class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $barang->kategori }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status Stok</dt>
                                <dd class="mt-1">
                                    @if ($barang->stok > 10)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Tersedia
                                        </span>
                                    @elseif($barang->stok > 0)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>
                                            Menipis
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Habis
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jumlah Stok</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ number_format($barang->stok) }}
                                    {{ $barang->satuan }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Harga Satuan</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">Rp
                                    {{ number_format($barang->harga, 0, ',', '.') }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Total Nilai</dt>
                                <dd class="mt-1 text-lg text-gray-900 font-bold">Rp
                                    {{ number_format($barang->stok * $barang->harga, 0, ',', '.') }}</dd>
                            </div>
                            @if ($barang->deskripsi)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $barang->deskripsi }}</dd>
                                </div>
                            @endif
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Ditambahkan</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $barang->created_at->format('d M Y, H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir Update</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $barang->updated_at->format('d M Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Activity Log (Future feature) -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Riwayat Aktivitas</h3>
                        <div class="text-center py-8">
                            <i class="fas fa-history text-gray-400 text-4xl mb-4"></i>
                            <p class="text-gray-500">Fitur riwayat aktivitas akan segera hadir</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Image -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Gambar Barang</h3>
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}"
                                class="w-full h-64 object-cover rounded-lg border border-gray-300">
                        @else
                            <div
                                class="w-full h-64 bg-gray-100 rounded-lg border border-gray-300 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                                    <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Statistik Cepat</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-boxes text-blue-500 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Stok Tersisa</span>
                                </div>
                                <span class="text-lg font-bold text-blue-600">{{ number_format($barang->stok) }}</span>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Nilai Total</span>
                                </div>
                                <span class="text-lg font-bold text-green-600">Rp
                                    {{ number_format($barang->stok * $barang->harga, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-tag text-purple-500 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Harga Satuan</span>
                                </div>
                                <span class="text-lg font-bold text-purple-600">Rp
                                    {{ number_format($barang->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.barang.edit', $barang->id) }}"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Barang
                            </a>
                            <button onclick="window.print()"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-print mr-2"></i>
                                Print Detail
                            </button>
                            <a href="{{ route('admin.barang.index') }}"
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-list mr-2"></i>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection
