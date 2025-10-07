<?php

namespace App\Notifications;

use App\Models\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewWithdrawRequestNotification extends Notification
{
    use Queueable;

    protected $withdraw;

    public function __construct(Withdraw $withdraw)
    {
        $this->withdraw = $withdraw;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // You can add 'mail' if you want email notification
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'withdraw_id' => $this->withdraw->id,
            'user_name' => $this->withdraw->user->name,
            'amount' => $this->withdraw->amount,
            'message' => $this->withdraw->user->name . ' requested a withdraw of $' . $this->withdraw->amount,
        ];
    }
}
