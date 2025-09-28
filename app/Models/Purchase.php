<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'package_id',
        'first_price',
        'renew_price',
        'status',
        'expires_at',
    ];

    protected $dates = ['expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function histories()
    {
        return $this->hasMany(PurchaseHistory::class);
    }

    public function isActive()
    {
        return $this->expires_at && Carbon::now()->lt($this->expires_at);
    }

    public function renew()
    {
        $period = $this->package->billing_cycle === 'monthly' ? 1 : 12;
        $this->expires_at = $this->expires_at && $this->expires_at->isFuture()
            ? $this->expires_at->addMonths($period)
            : now()->addMonths($period);

        $this->status = 'completed';
        $this->save();
    }

    public function recordHistory($type, $amount)
    {
        return PurchaseHistory::create([
            'purchase_id' => $this->id,
            'user_id' => $this->user_id,
            'package_id' => $this->package_id,
            'type' => $type,
            'amount' => $amount,
            'transaction_date' => now(),
        ]);
    }
}
