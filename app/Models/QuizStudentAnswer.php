<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizStudentAnswer extends Model
{
    protected $table = 'quiz_student_answers';

    protected $fillable = [
        'quiz_attempt_id',
        'quiz_question_id',
        'jawaban_siswa',
        'is_correct',
        'nilai_didapat',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id');
    }
}