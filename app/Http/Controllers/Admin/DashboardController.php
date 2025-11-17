<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use PDF; // <-- JANGAN LUPA TAMBAHKAN INI
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Statistik untuk dashboard
        $totalBarang = Barang::count();
        $stokTersedia = Barang::where('stok', '>', 10)->count();
        $stokMenipis = Barang::where('stok', '>', 0)->where('stok', '<=', 10)->count();
        $stokHabis = Barang::where('stok', 0)->count();


        // Total stock semua barang
        $totalStock = Barang::sum('stok');

        // Total nilai inventory (stok * harga)
        $totalNilaiInventory = Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0;

        // Barang terbaru (5 terakhir)
        $barangTerbaru = Barang::orderBy('created_at', 'desc')->limit(5)->get();

        // Data untuk chart kategori
        $kategoriStats = Barang::selectRaw('kategori, COUNT(*) as total, SUM(stok) as total_stok')
            ->groupBy('kategori')
            ->get()
            ->keyBy('kategori');

        // Barang dengan stok terbanyak
        $barangTerbanyak = Barang::orderBy('stok', 'desc')->limit(5)->get();

        // Barang dengan nilai tertinggi
        $barangTermahal = Barang::orderByRaw('stok * harga DESC')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalBarang',
            'stokTersedia',
            'stokMenipis',
            'stokHabis',
            'totalStock',
            'totalNilaiInventory',
            'barangTerbaru',
            'kategoriStats',
            'barangTerbanyak',
            'barangTermahal'
        ));
    }

    public function exportPDF() // <-- TAMBAHKAN METODE BARU INI
    {
        // Ambil semua data yang sama persis seperti di metode index()
        $data = [
            'totalBarang' => Barang::count(),
            'stokTersedia' => Barang::where('stok', '>', 10)->count(),
            'stokMenipis' => Barang::where('stok', '>', 0)->where('stok', '<=', 10)->count(),
            'stokHabis' => Barang::where('stok', 0)->count(),
            'totalStock' => Barang::sum('stok'),
            'totalNilaiInventory' => Barang::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0,
            'barangTerbaru' => Barang::orderBy('created_at', 'desc')->limit(5)->get(),
            'barangTerbanyak' => Barang::orderBy('stok', 'desc')->limit(5)->get(),
            'barangTermahal' => Barang::orderByRaw('stok * harga DESC')->limit(5)->get(),
            'tanggal' => date('d F Y') // Tambahkan tanggal cetak
        ];

        // Load view PDF dengan data yang sudah disiapkan
        $pdf = PDF::loadView('admin.dashboard_pdf', $data);

        // Atur nama file yang akan di-download
        $fileName = 'Laporan_Dashboard_Inventaris_' . date('Y-m-d') . '.pdf';

        // Download file PDF
        return $pdf->download($fileName);
    }
    public function getStats()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'stok_tersedia' => Barang::where('stok', '>', 10)->count(),
            'stok_menipis' => Barang::where('stok', '>', 0)->where('stok', '<=', 10)->count(),
            'stok_habis' => Barang::where('stok', 0)->count(),
            'total_nilai_inventory' => Barang::sum(\DB::raw('stok * harga')),
        ];

        return response()->json($stats);
    }
}
