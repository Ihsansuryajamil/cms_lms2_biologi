<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'quiz_id', 'student_id', 'skor', 'status', 
        'started_at', 'submitted_at', 'waktu_pengerjaan_detik', 'created_at'
    ];
}
