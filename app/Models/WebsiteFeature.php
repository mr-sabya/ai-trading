<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tab_title',
        'main_image',
        'floating_top_image',
        'floating_top_text',
        'floating_bottom_number',
        'floating_bottom_text',
        'is_active',
    ];
}
