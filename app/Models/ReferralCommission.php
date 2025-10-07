<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'user_id',
        'referred_user_id',
        'generation',
        'amount',
        'commission_percent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referredUser()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
