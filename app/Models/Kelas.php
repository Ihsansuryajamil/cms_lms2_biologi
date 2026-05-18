<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'nama',
        'deskripsi',
        'guru_id',
        'mata_pelajaran',
        'tahun_ajaran',
        'semester',
        'jumlah_peserta',
        'status',
    ];
}
