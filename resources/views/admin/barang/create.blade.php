@extends('layouts.app')

@section('title', 'Tambah Barang - Inventory')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.barang.index') }}"
                    class="text-gray-400 hover:text-primary-600 transition-colors duration-300">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Barang Baru</h1>
                    <p class="mt-1 text-gray-600">Lengkapi detail barang di bawah ini.</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-lg rounded-xl">
            <form method="POST" action="{{ route('admin.barang.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <!-- Nama Barang -->
                        <div class="md:col-span-2">
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama_barang" id="nama_barang" value="{{ old('nama_barang') }}"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nama_barang') border-red-500 @enderror"
                                placeholder="Contoh: Meja Belajar Kayu Jati">
                            @error('nama_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode Barang -->
                        <div>
                            <label for="kode_barang" class="block text-sm font-medium text-gray-700">Kode Barang</label>
                            <input type="text" name="kode_barang" id="kode_barang" value="{{ old('kode_barang') }}"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm bg-gray-50 @error('kode_barang') border-red-500 @enderror"
                                placeholder="Otomatis atau isi manual">
                            @error('kode_barang')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori <span
                                    class="text-red-500">*</span></label>
                            <select name="kategori" id="kategori" required
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('kategori') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="Elektronik" {{ old('kategori') == 'Elektronik' ? 'selected' : '' }}>
                                    Elektronik</option>
                                <option value="Furniture" {{ old('kategori') == 'Furniture' ? 'selected' : '' }}>Furniture
                                </option>
                                <option value="Alat Tulis" {{ old('kategori') == 'Alat Tulis' ? 'selected' : '' }}>Alat
                                    Tulis</option>
                                <option value="Makanan" {{ old('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan
                                </option>
                                <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="stok" class="block text-sm font-medium text-gray-700">Stok Awal <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok') }}" required
                                min="0"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('stok') border-red-500 @enderror"
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
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('satuan') border-red-500 @enderror">
                                <option value="">Pilih Satuan</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kg</option>
                                <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>Liter</option>
                                <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>Box</option>
                                <option value="pack" {{ old('satuan') == 'pack' ? 'selected' : '' }}>Pack</option>
                            </select>
                            @error('satuan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div class="md:col-span-2">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga per Satuan <span
                                    class="text-red-500">*</span></label>
                            <div class="mt-1 relative rounded-lg shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="harga" id="harga" value="{{ old('harga') }}" required
                                    min="0"
                                    class="block w-full pl-10 pr-3 py-2 border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('harga') border-red-500 @enderror"
                                    placeholder="0">
                            </div>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('deskripsi') border-red-500 @enderror"
                                placeholder="Spesifikasi, warna, ukuran, dll. (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Gambar Barang</label>
                            <div id="image-preview" class="hidden mt-2 w-48 h-48 relative">
                                <img src="" class="w-full h-full object-cover rounded-lg">
                                <button type="button" id="remove-image"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">&times;</button>
                            </div>
                            <div id="image-upload-box"
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="gambar"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                            <span>Pilih file untuk diupload</span>
                                            <input id="gambar" name="gambar" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-6 py-4 bg-gray-50 text-right rounded-b-xl">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.barang.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Barang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto generate kode barang
            const namaBarangInput = document.getElementById('nama_barang');
            const kodeBarangInput = document.getElementById('kode_barang');

            namaBarangInput.addEventListener('blur', function() {
                if (!kodeBarangInput.value.trim()) {
                    const namePart = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 4);
                    const randomPart = Math.floor(Math.random() * 900) + 100; // 3 digit random number
                    if (namePart) {
                        kodeBarangInput.value = namePart + '-' + randomPart;
                    }
                }
            });

            // Image preview
            const gambarInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewImg = imagePreview.querySelector('img');
            const imageUploadBox = document.getElementById('image-upload-box');
            const removeImageBtn = document.getElementById('remove-image');

            gambarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreviewImg.src = event.target.result;
                        imagePreview.classList.remove('hidden');
                        imageUploadBox.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeImageBtn.addEventListener('click', function() {
                gambarInput.value = ''; // Clear the file input
                imagePreviewImg.src = '';
                imagePreview.classList.add('hidden');
                imageUploadBox.classList.remove('hidden');
            });
        });
    </script>
@endsection
