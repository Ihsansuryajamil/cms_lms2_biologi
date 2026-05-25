<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'nama_course',
        'user_id',
        'kode_course',
        'deskripsi',
        'persyaratan',
        'link_video',
        'avatar'
    ];

    // Hubungan Balik ke Guru yang membuat kelas
    public function pembuat(): BelongsTo
    {
        return $table->belongsTo(User::class, 'user_id');
    }

    // Hubungan Course memiliki banyak Bab/Topic
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'course_id')->orderBy('urutan', 'asc');
    }
}