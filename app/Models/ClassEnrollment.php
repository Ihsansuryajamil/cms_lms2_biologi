<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassEnrollment extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id', 'student_id', 'enrollment_status', 
        'enrolled_at', 'completed_at', 'created_at'
    ];
}
