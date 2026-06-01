<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'sub_topic_id',
        'tipe',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban_pg',
        'bobot_nilai',
    ];

    // Relasi balik ke Sub-Topik (Aktivitas Kuis)
    public function subTopic(): BelongsTo
    {
        return $this->belongsTo(SubTopic::class, 'sub_topic_id');
    }

    // Relasi ke jawaban spesifik siswa (opsional untuk nanti)
    public function studentAnswers(): HasMany
    {
        return $this->hasMany(QuizStudentAnswer::class, 'quiz_question_id');
    }
}