<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'topic_id', 'judul', 'durasi_menit', 'total_pertanyaan', 
        'passing_score', 'poin', 'auto_grade', 'status', 'created_at'
    ];
}
