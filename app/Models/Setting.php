<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'website_name',
        'tagline',
        'light_logo',
        'dark_logo',
        'favicon',
        'copyright',
        'short_description',
        'phone',
        'email',
        'address',
        'facebook',
        'instagram',
        'linkedin',
        'youtube',
        'twitter',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'timezone',
        'currency',
        'maintenance_mode',
        'google_analytics',
        'facebook_pixel',
    ];
}
