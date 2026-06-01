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

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // PASTIKAN FUNGSI INI ADA
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'course_id')->orderBy('urutan', 'asc');
    }
}