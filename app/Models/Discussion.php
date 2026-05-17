<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'class_id', 'author_id', 'judul', 'konten', 'parent_id', 
        'total_replies', 'is_pinned', 'status', 'created_at'
    ];
}
