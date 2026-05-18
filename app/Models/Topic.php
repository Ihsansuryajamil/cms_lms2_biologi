<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id',
        'judul',
        'deskripsi',
        'urutan',
        'status',
        'created_at'
    ];
}
