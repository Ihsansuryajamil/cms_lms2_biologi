<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'user_id', 'judul', 'pesan', 'tipe', 'related_id', 
        'related_type', 'is_read', 'read_at', 'created_at'
    ];
}
