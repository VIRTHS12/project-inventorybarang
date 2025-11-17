<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            // 1. Kolom ID utama
            $table->id();

            // 2. Kolom untuk User yang melakukan aksi (Boleh kosong)
            // Terhubung ke tabel 'users', jika user dihapus, kolom ini jadi NULL
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // 3. Kolom untuk jenis event (created, updated, deleted)
            $table->string('event');

            // 4. Kolom Polymorphic untuk model yang diaudit
            // Ini akan membuat 'auditable_id' (BIGINT) dan 'auditable_type' (VARCHAR)
            $table->morphs('auditable');

            // 5. Kolom untuk menyimpan data lama dan baru (dalam format JSON)
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();

            // 6. Kolom timestamp (created_at dan updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_trails');
    }
};
