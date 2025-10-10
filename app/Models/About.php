<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'highlight',
        'subtitle',
        'description',
        'button_text',
        'button_link',
        'image',
        'exp_years_label',
        'exp_years_value',
        'customers_label',
        'customers_value',
    ];
}
