<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'topic_id', 'judul', 'deskripsi', 'file_url', 
        'deadline', 'poin', 'urutan', 'status', 'created_at'
    ];
}
