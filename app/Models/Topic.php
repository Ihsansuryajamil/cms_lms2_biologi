<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    protected $fillable = [
        'course_id',
        'nama_topic',
        'durasi_pembelajaran',
        'urutan'
    ];

    // Relasi ke atas: Mengetahui topik ini milik course mana
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relasi ke bawah: Topik memiliki banyak Sub-Topik (Materi/Quiz/Tugas)
    // PASTIKAN FUNGSI INI ADA DAN TEPAT PENULISANNYA: subTopics
    public function subTopics(): HasMany
    {
        return $this->hasMany(SubTopic::class, 'topic_id')->orderBy('urutan', 'asc');
    }
}