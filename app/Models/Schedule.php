<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'created_at'
    ];
}
