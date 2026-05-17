<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'quiz_id', 'pertanyaan', 'jenis', 'poin', 'urutan', 'created_at'
    ];
}
