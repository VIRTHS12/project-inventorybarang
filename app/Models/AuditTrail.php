<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditTrail extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model.
     *
     * @var string
     */
    protected $table = 'audit_trails';

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event',
        'auditable_type',
        'auditable_id',
        'old_values',
        'new_values',
    ];

    /**
     * Atribut yang harus di-cast ke tipe data asli.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Mendapatkan model user yang terkait dengan audit.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan model parent yang diaudit (polymorphic).
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }
}
