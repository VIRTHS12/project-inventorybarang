<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'LAP001',
                'nama_barang' => 'Laptop ASUS ROG',
                'kategori' => 'Elektronik',
                'deskripsi' => 'Laptop gaming dengan spesifikasi tinggi, RAM 16GB, SSD 512GB',
                'stok' => 5,
                'satuan' => 'pcs',
                'harga' => 15000000,
            ],
            [
                'kode_barang' => 'MOU001',
                'nama_barang' => 'Mouse Logitech MX Master 3',
                'kategori' => 'Elektronik',
                'deskripsi' => 'Mouse wireless dengan presisi tinggi untuk produktivitas',
                'stok' => 25,
                'satuan' => 'pcs',
                'harga' => 1200000,
            ],
            [
                'kode_barang' => 'MJA001',
                'nama_barang' => 'Meja Kantor Kayu Jati',
                'kategori' => 'Furniture',
                'deskripsi' => 'Meja kantor dari kayu jati solid dengan laci',
                'stok' => 8,
                'satuan' => 'pcs',
                'harga' => 2500000,
            ],
            [
                'kode_barang' => 'KUR001',
                'nama_barang' => 'Kursi Ergonomis',
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis dengan penyangga punggung',
                'stok' => 12,
                'satuan' => 'pcs',
                'harga' => 1800000,
            ],
            [
                'kode_barang' => 'PUL001',
                'nama_barang' => 'Pulpen Pilot',
                'kategori' => 'Alat Tulis',
                'deskripsi' => 'Pulpen gel dengan tinta halus warna biru',
                'stok' => 100,
                'satuan' => 'pcs',
                'harga' => 5000,
            ],
            [
                'kode_barang' => 'KER001',
                'nama_barang' => 'Kertas A4 80gsm',
                'kategori' => 'Alat Tulis',
                'deskripsi' => 'Kertas fotocopy A4 kualitas premium',
                'stok' => 50,
                'satuan' => 'pack',
                'harga' => 45000,
            ],
            [
                'kode_barang' => 'KOP001',
                'nama_barang' => 'Kopi Arabica Premium',
                'kategori' => 'Makanan',
                'deskripsi' => 'Kopi arabica single origin dari Aceh Gayo',
                'stok' => 0,
                'satuan' => 'kg',
                'harga' => 150000,
            ],
            [
                'kode_barang' => 'TEH001',
                'nama_barang' => 'Teh Earl Grey',
                'kategori' => 'Makanan',
                'deskripsi' => 'Teh premium dengan aroma bergamot',
                'stok' => 3,
                'satuan' => 'box',
                'harga' => 75000,
            ],
            [
                'kode_barang' => 'CAB001',
                'nama_barang' => 'Kabel HDMI 2m',
                'kategori' => 'Elektronik',
                'deskripsi' => 'Kabel HDMI 4K support panjang 2 meter',
                'stok' => 15,
                'satuan' => 'pcs',
                'harga' => 85000,
            ],
            [
                'kode_barang' => 'LEM001',
                'nama_barang' => 'Lemari Arsip 4 Laci',
                'kategori' => 'Furniture',
                'deskripsi' => 'Lemari arsip besi dengan 4 laci dan kunci',
                'stok' => 6,
                'satuan' => 'pcs',
                'harga' => 1200000,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
