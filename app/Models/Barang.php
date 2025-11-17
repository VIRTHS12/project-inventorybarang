<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'deskripsi',
        'stok',
        'satuan',
        'harga',
        'gambar'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];

    /**
     * Accessor untuk format harga
     */
    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Accessor untuk status stok
     */
    public function getStatusStokAttribute()
    {
        if ($this->stok > 10) {
            return 'tersedia';
        } elseif ($this->stok > 0) {
            return 'menipis';
        } else {
            return 'habis';
        }
    }

    /**
     * Accessor untuk badge status
     */
    public function getStatusBadgeAttribute()
    {
        $status = $this->status_stok;

        switch ($status) {
            case 'tersedia':
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>';
            case 'menipis':
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menipis</span>';
            case 'habis':
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Habis</span>';
            default:
                return '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>';
        }
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByKategori(Builder $query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk filter berdasarkan status stok
     */
    public function scopeByStatusStok(Builder $query, $status)
    {
        switch ($status) {
            case 'tersedia':
                return $query->where('stok', '>', 10);
            case 'menipis':
                return $query->where('stok', '>', 0)->where('stok', '<=', 10);
            case 'habis':
                return $query->where('stok', 0);
            default:
                return $query;
        }
    }
    public function audits()
    {
        return $this->morphMany(\App\Models\AuditTrail::class, 'auditable');
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('nama_barang', 'like', "%{$search}%")
                ->orWhere('kode_barang', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        });
    }

    /**
     * Generate kode barang otomatis
     */
    public static function generateKodeBarang($namaBarang)
    {
        $prefix = strtoupper(substr(str_replace(' ', '', $namaBarang), 0, 3));
        $lastBarang = self::where('kode_barang', 'like', $prefix . '%')
            ->orderBy('kode_barang', 'desc')
            ->first();

        if ($lastBarang) {
            $lastNumber = (int) substr($lastBarang->kode_barang, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
