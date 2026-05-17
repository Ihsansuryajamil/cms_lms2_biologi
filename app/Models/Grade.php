<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id', 'student_id', 'nilai_tugas', 
        'nilai_quiz', 'nilai_akhir', 'grade_letter', 'updated_at'
    ];
}
