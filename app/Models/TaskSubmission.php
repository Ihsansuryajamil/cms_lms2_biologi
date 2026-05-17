<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'task_id', 'student_id', 'file_url', 'submitted_at', 
        'status', 'nilai', 'feedback', 'graded_at', 'graded_by', 'created_at'
    ];
}
