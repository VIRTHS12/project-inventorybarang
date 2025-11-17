@extends('layouts.app')

@section('title', 'Jejak Audit - Inventory')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Jejak Audit</h1>
                <p class="mt-1 text-gray-600">Lacak semua perubahan yang terjadi pada data inventaris.</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white shadow-lg rounded-xl mb-8">
            <div class="p-4 sm:p-6">
                <form method="GET" action="{{ route('admin.audit.index') }}"
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="user" class="block text-sm font-medium text-gray-700">Pengguna</label>
                        <select name="user" id="user"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            <option value="">Semua Pengguna</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-filter"></i>
                        </button>
                        <a href="{{ route('admin.audit.index') }}"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Audit Timeline -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            @forelse ($audits as $audit)
                <ol class="relative border-l border-gray-200">
                    {{-- Loop untuk setiap item audit --}}
                    <li class="mb-10 ml-6">
                        {{-- Set ikon dan warna berdasarkan event --}}
                        @php
                            $iconClass = '';
                            $bgClass = '';
                            $textClass = '';
                            switch ($audit->event) {
                                case 'created':
                                    $iconClass = 'fas fa-plus';
                                    $bgClass = 'bg-green-100';
                                    $textClass = 'text-green-600';
                                    break;
                                case 'updated':
                                    $iconClass = 'fas fa-edit';
                                    $bgClass = 'bg-blue-100';
                                    $textClass = 'text-blue-600';
                                    break;
                                case 'deleted':
                                    $iconClass = 'fas fa-trash';
                                    $bgClass = 'bg-red-100';
                                    $textClass = 'text-red-600';
                                    break;
                            }
                        @endphp

                        <span class="absolute flex items-center justify-center w-6 h-6 {{ $bgClass }} rounded-full -left-3 ring-8 ring-white">
                            <i class="{{ $iconClass }} {{ $textClass }} text-xs"></i>
                        </span>

                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="items-center justify-between mb-3 sm:flex">
                                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">
                                    {{ $audit->created_at->diffForHumans() }}
                                </time>
                                <div class="text-sm font-normal text-gray-500">
                                    <a href="#" class="font-semibold text-gray-900 hover:underline">
                                        {{ $audit->user->name ?? 'Sistem' }}
                                    </a>
                                    {{ $audit->event === 'updated' ? 'mengubah data' : ($audit->event === 'created' ? 'menambahkan' : 'menghapus') }}
                                    {{ class_basename($audit->auditable_type) }}:
                                    <span class="font-semibold text-primary-700">
                                        {{-- Menampilkan nama barang dari data lama atau baru --}}
                                        {{ $audit->old_values['nama_barang'] ?? $audit->new_values['nama_barang'] ?? 'Data tidak diketahui' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Tampilkan detail perubahan HANYA untuk event 'updated' --}}
                            @if ($audit->event === 'updated' && !empty($audit->new_values))
                                <div class="p-3 text-xs font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50">
                                    <p class="font-semibold mb-2">Detail Perubahan:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                    @foreach ($audit->new_values as $field => $newValue)
                                        @if(isset($audit->old_values[$field]) && $audit->old_values[$field] != $newValue)
                                            <li>
                                                <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $field)) }}</span> diubah dari
                                                <code class="font-semibold text-red-700">"{{ $audit->old_values[$field] }}"</code> menjadi
                                                <code class="font-semibold text-green-700">"{{ $newValue }}"</code>.
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </li>
                </ol>
            @empty
                {{-- Tampilan jika tidak ada data audit --}}
                <div class="text-center py-16">
                    <i class="fas fa-history text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Aktivitas</h3>
                    <p class="text-gray-500">Tidak ada jejak audit yang tercatat untuk filter yang dipilih.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $audits->links() }}
        </div>
    </div>
@endsection

