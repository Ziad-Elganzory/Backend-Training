<?php

namespace App\Listeners;

use App\Events\PaymentSucceeded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyAdminAboutPayment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentSucceeded $event): void
    {
        Log::info("Admin Notified About Payment successfully",[
            "payment_id" => $event->payment['payment_id'],
            "order_id" => $event->payment['order_id'],
        ]);   
    }
}
