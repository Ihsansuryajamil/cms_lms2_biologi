<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassEnrollmentRequest extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id', 'student_id', 'status', 'alasan_penolakan', 
        'requested_at', 'approved_by', 'approved_at', 'created_at'
    ];
}
