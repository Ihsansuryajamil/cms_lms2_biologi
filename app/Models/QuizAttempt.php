<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $fillable = [
        'sub_topic_id',
        'student_id',
        'total_nilai',
        'status',
        'started_at',
        'finished_at',
    ];

    public function subTopic(): BelongsTo
    {
        return $this->belongsTo(SubTopic::class, 'sub_topic_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Mengambil semua jawaban detail siswa pada sesi kuis ini
    public function answers(): HasMany
    {
        return $this->hasMany(QuizStudentAnswer::class, 'quiz_attempt_id');
    }
}