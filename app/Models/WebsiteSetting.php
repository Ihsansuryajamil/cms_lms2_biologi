<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $table = 'website_settings';

    protected $fillable = [
        'nama_website',
        'nama_institusi',
        'tagline',
        'logo',
        'favicon'
    ];
}