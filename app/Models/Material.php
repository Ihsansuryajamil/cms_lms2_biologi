<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'topic_id', 'judul', 'konten', 'file_url', 
        'file_type', 'urutan', 'status', 'created_at'
    ];
}
