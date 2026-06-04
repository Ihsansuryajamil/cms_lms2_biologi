<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KelasUser extends Model
{
    // Mengunci nama tabel secara manual agar terbaca sesuai SQL Anda
    protected $table = 'kelas_user';

    protected $fillable = [
        'teacher_id',
        'nama_kelas',
        'deskripsi_kelas',
        'tahun_ajar',
    ];

    /**
     * Relasi Balik ke Guru (Siapa yang membuat kelas ini)
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /**
     * Relasi ke Murid-Murid (Mendapatkan semua murid di dalam kelas ini)
     */
    public function murid(): HasMany
    {
        return $this->hasMany(User::class, 'kelas_id');
    }
}