<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'billing_cycle',
        'first_price',
        'renew_price',
        'is_active',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
