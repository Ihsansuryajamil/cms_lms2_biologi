<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttemptAnswer extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'attempt_id', 'question_id', 'jawaban_text', 
        'answer_id', 'is_correct', 'created_at'
    ];
}
