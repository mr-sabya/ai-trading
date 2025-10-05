<?php

namespace App\Notifications;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPurchaseNotification extends Notification
{
    use Queueable;

    protected $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // or ['mail','database'] if you also want email
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'purchase_id' => $this->purchase->id,
            'user_name'   => $this->purchase->user->name,
            'package'     => $this->purchase->package->name,
            'price'       => $this->purchase->first_price,
            'message'     => $this->purchase->user->name . ' purchased ' . $this->purchase->package->name,
        ];
    }
}
