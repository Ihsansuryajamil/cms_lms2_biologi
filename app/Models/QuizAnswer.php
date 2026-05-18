<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'question_id', 'jawaban', 'is_correct', 'urutan', 'created_at'
    ];
}
