@extends('layouts.app')

@section('title', 'Edit Barang - Inventory')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.barang.index') }}" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Barang</h1>
                    <p class="mt-2 text-gray-600">Perbarui informasi barang: {{ $barang->nama_barang }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow rounded-lg">
            <form method="POST" action="{{ route('admin.barang.update', $barang->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kode Barang -->
                        <div>
                            <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang"
                                value="{{ old('kode_barang', $barang->kode_barang) }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('kode_barang') border-red-300 @enderror"
                                placeholder="Contoh: BRG001">
                            @error('kode_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Barang -->
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_barang" id="nama_barang"
                                value="{{ old('nama_barang', $barang->nama_barang) }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nama_barang') border-red-300 @enderror"
                                placeholder="Masukkan nama barang">
                            @error('nama_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori <span
                                    class="text-red-500">*</span></label>
                            <select name="kategori" id="kategori" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('kategori') border-red-300 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="Elektronik"
                                    {{ old('kategori', $barang->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik
                                </option>
                                <option value="Furniture"
                                    {{ old('kategori', $barang->kategori) == 'Furniture' ? 'selected' : '' }}>Furniture
                                </option>
                                <option value="Alat Tulis"
                                    {{ old('kategori', $barang->kategori) == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis
                                </option>
                                <option value="Makanan"
                                    {{ old('kategori', $barang->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan
                                </option>
                                <option value="Lainnya"
                                    {{ old('kategori', $barang->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700">Stok <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok', $barang->stok) }}"
                                required min="0"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('stok') border-red-300 @enderror"
                                placeholder="0">
                            @error('stok')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Satuan -->
                        <div>
                            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan <span
                                    class="text-red-500">*</span></label>
                            <select name="satuan" id="satuan" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('satuan') border-red-300 @enderror">
                                <option value="">Pilih Satuan</option>
                                <option value="pcs" {{ old('satuan', $barang->satuan) == 'pcs' ? 'selected' : '' }}>Pcs
                                </option>
                                <option value="kg" {{ old('satuan', $barang->satuan) == 'kg' ? 'selected' : '' }}>Kg
                                </option>
                                <option value="liter" {{ old('satuan', $barang->satuan) == 'liter' ? 'selected' : '' }}>
                                    Liter</option>
                                <option value="meter" {{ old('satuan', $barang->satuan) == 'meter' ? 'selected' : '' }}>
                                    Meter</option>
                                <option value="box" {{ old('satuan', $barang->satuan) == 'box' ? 'selected' : '' }}>Box
                                </option>
                                <option value="pack" {{ old('satuan', $barang->satuan) == 'pack' ? 'selected' : '' }}>
                                    Pack</option>
                            </select>
                            @error('satuan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="harga" id="harga"
                                    value="{{ old('harga', $barang->harga) }}" required min="0"
                                    class="block w-full pl-12 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('harga') border-red-300 @enderror"
                                    placeholder="0">
                            </div>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('deskripsi') border-red-300 @enderror"
                            placeholder="Masukkan deskripsi barang (opsional)">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="mt-6">
                        <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Barang</label>

                        @if ($barang->gambar)
                            <div class="mt-2 mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}"
                                    class="h-32 w-32 object-cover rounded-lg border border-gray-300">
                            </div>
                        @endif

                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                        <span>{{ $barang->gambar ? 'Ganti gambar' : 'Upload gambar' }}</span>
                                        <input id="gambar" name="gambar" type="file" class="sr-only"
                                            accept="image/*">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.barang.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-save mr-2"></i>
                            Update Barang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview gambar baru
        document.addEventListener('DOMContentLoaded', function() {
            const gambarInput = document.getElementById('gambar');
            gambarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        console.log('New image selected:', file.name);
                        // You can add image preview here if needed
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
