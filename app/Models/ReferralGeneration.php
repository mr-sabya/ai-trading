<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralGeneration extends Model
{
    use HasFactory;

    protected $fillable = [
        'generation',          // 1, 2, 3, etc.
        'commission_percent',  // e.g., 10, 4, 1
    ];
}
