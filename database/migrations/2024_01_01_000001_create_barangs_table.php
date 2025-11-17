<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->integer('stok')->default(0);
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->string('gambar')->nullable();
            $table->timestamps();

            // Index untuk optimasi query
            $table->index(['kategori', 'stok']);
            $table->index('nama_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
