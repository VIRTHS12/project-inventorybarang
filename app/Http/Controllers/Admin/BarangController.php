<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        // Filter berdasarkan status stok
        if ($request->filled('status')) {
            $query->byStatusStok($request->status);
        }

        // Urutkan berdasarkan yang terbaru
        $barangs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:50|unique:barangs,kode_barang',
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('barang-images', 'public');
        }

        $barang = Barang::create($validated);

        // -- LOG AUDIT: BARANG DIBUAT --
        $barang->audits()->create([
            'user_id' => Auth::id(),
            'event' => 'created',
            'new_values' => $barang->toArray(),
        ]);
        // -----------------------------

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Memperbarui data barang di database.
     */
    public function update(Request $request, Barang $barang): RedirectResponse
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'nullable|string|max:50|unique:barangs,kode_barang,' . $barang->id,
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // -- LOG AUDIT: Simpan nilai lama sebelum diubah --
        $oldValues = $barang->getOriginal();
        // --------------------------------------------------

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('barang-images', 'public');
        }

        $barang->update($validated);

        // -- LOG AUDIT: BARANG DIUBAH --
        $barang->audits()->create([
            'user_id' => Auth::id(),
            'event' => 'updated',
            'old_values' => $oldValues,
            'new_values' => $barang->getChanges(),
        ]);
        // -----------------------------

        return redirect()->route('admin.barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    /**
     * Menghapus barang dari database.
     */
    public function destroy(Barang $barang): RedirectResponse
    {
        // -- LOG AUDIT: Simpan nilai lama sebelum dihapus --
        $oldValues = $barang->toArray();
        // --------------------------------------------------

        // Hapus gambar dari storage
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        // -- LOG AUDIT: BARANG DIHAPUS --
        // Karena barang sudah dihapus, kita buat log secara manual
        \App\Models\AuditTrail::create([
            'user_id' => Auth::id(),
            'event' => 'deleted',
            'auditable_type' => Barang::class,
            'auditable_id' => $barang->id,
            'old_values' => $oldValues,
        ]);
        // -----------------------------

        return redirect()->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }


    public function show(Barang $barang): View
    {

        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('admin.barang.edit', compact('barang'));
    }
}
