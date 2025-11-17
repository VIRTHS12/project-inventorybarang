@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Data Barang</h1>
                <p class="mt-1 text-gray-600">Kelola semua data barang dalam inventory Anda.</p>
            </div>
        </div>

        <div class="mt-8">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center" method="GET" action="{{ route('admin.barang.index') }}">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="simple-search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full pl-10 p-2.5"
                                placeholder="Cari barang berdasarkan nama atau kode...">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a href="{{ route('admin.barang.create') }}"
                        class="flex items-center justify-center text-white bg-teal-500 hover:bg-teal-600 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-4 py-2">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Tambah Barang
                    </a>
                    {{-- Di sini Anda bisa menambahkan tombol filter jika diperlukan --}}
                </div>
            </div>
        </div>

        <div class="mt-6 bg-white shadow-md rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Barang</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-center">Stok</th>
                            <th scope="col" class="px-6 py-3 text-right">Harga</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                    <img class="w-12 h-12 rounded-lg object-cover"
                                        src="{{ $barang->gambar ? asset('storage/' . $barang->gambar) : 'https://placehold.co/600x400/e2e8f0/e2e8f0/png?text=No+Image' }}"
                                        alt="{{ $barang->nama_barang }}">
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ $barang->nama_barang }}</div>
                                        <div class="font-normal text-gray-500">{{ $barang->kode_barang }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">{{ $barang->kategori }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center">
                                        @if ($barang->stok > 10)
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> Tersedia
                                        @elseif($barang->stok > 0)
                                            <div class="h-2.5 w-2.5 rounded-full bg-yellow-400 mr-2"></div> Menipis
                                        @else
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div> Habis
                                        @endif
                                    </div>
                                    <div class="text-center text-xs text-gray-500 mt-1">({{ $barang->stok }}
                                        {{ $barang->satuan }})</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="font-semibold text-gray-800">
                                        Rp{{ number_format($barang->harga, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div x-data="{ dropdownOpen: false }" class="relative">
                                        <button @click="dropdownOpen = !dropdownOpen"
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 4 15">
                                                <path
                                                    d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                            </svg>
                                        </button>
                                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                                            class="absolute right-0 z-10 w-44 bg-white rounded-lg shadow-lg">
                                            <ul class="py-1 text-sm text-gray-700">
                                                <li><a href="{{ route('admin.barang.show', $barang->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Lihat Detail</a></li>
                                                <li><a href="{{ route('admin.barang.edit', $barang->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">Edit</a></li>
                                                <li>
                                                    <button type="button"
                                                        onclick="openDeleteModal('{{ route('admin.barang.destroy', $barang->id) }}', '{{ $barang->nama_barang }}')"
                                                        class="w-full flex items-center justify-center px-4 py-2 text-red-600 hover:bg-gray-100">Hapus</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-16 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="mt-2 text-xl font-semibold text-gray-900">Data Barang Kosong</h3>
                                    <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau tambahkan barang baru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <nav class="p-4" aria-label="Table navigation">
                {{ $barangs->links() }}
            </nav>
        </div>
    </div>

    <div id="deleteModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Hapus Barang</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus barang <strong
                                        id="itemName"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button type="button" onclick="closeDeleteModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk modal, tidak perlu diubah --}}
    <script>
        function openDeleteModal(actionUrl, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const itemName = document.getElementById('itemName');
            form.action = actionUrl;
            itemName.textContent = name;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
        }
    </script>
@endsection
