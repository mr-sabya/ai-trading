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
        'binance_order_id',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
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

    /**
     * Determine if the purchase is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        // If expires_at is null, we might consider it never expires or as expired.
        // For typical subscriptions, a null expires_at usually means it's expired
        // or not properly set, so we'll treat it as expired.
        if (is_null($this->expires_at)) {
            return true; // Or false, depending on your business logic for null expiration
        }

        // Returns true if the current time is AFTER or AT the expires_at time.
        // This means it IS expired.
        return Carbon::now()->greaterThanOrEqualTo($this->expires_at);
        // Or simply:
        // return Carbon::now()->isAfter($this->expires_at); // if you want strict "after"
    }

    /**
     * Determine if the purchase is active (not expired).
     * This is often useful as a counterpoint to isExpired.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        // If expires_at is null, it's not active.
        if (is_null($this->expires_at)) {
            return false;
        }

        // Returns true if the current time is BEFORE the expires_at time.
        // This means it IS active.
        return Carbon::now()->lessThan($this->expires_at);
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


    public function referralCommissions()
    {
        return $this->hasMany(ReferralCommission::class);
    }


    public function generateReferralCommissions()
    {
        // Buyer
        $buyer = $this->user;

        if (!$buyer) return;

        // Load generation rules
        $generations = ReferralGeneration::orderBy('generation')->get();

        $currentReferrer = $buyer->referrer; // 1st generation
        $currentGeneration = 1;

        foreach ($generations as $gen) {
            if (!$currentReferrer) break; // Stop if no more referrers

            // Calculate commission amount
            $amount = ($this->first_price * $gen->commission_percent) / 100;

            // Create commission record
            ReferralCommission::create([
                'purchase_id' => $this->id,
                'user_id' => $currentReferrer->id,
                'referred_user_id' => $buyer->id,
                'generation' => $gen->generation,
                'amount' => $amount,
                'commission_percent' => $gen->commission_percent,
            ]);

            // Move up to next referrer in the chain
            $currentReferrer = $currentReferrer->referrer;
            $currentGeneration++;
        }
    }
}
