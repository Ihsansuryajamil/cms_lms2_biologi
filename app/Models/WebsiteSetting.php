<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'setting_key', 'setting_value', 'description', 
        'updated_by', 'updated_at'
    ];
}
