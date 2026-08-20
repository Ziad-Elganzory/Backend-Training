<?php

namespace App\Facades;

use App\Services\InventoryService;
use App\Services\NotificationService;
use App\Services\PaymentService;
use InvalidArgumentException;

class CheckoutFacade
{
    public function __construct(
        private InventoryService $inventory,
        private PaymentService $payment,
        private NotificationService $notification
    ){}

    public function place(array $order){
        if($order['items'] === []){
            throw new InvalidArgumentException("At least one item required");
        }

        $this->inventory->reserve($order['items']);

        $paymentId = $this->payment->charge($order['customer_id'],$order['amount']);

        $this->notification->send($order['email'],"Your order was placed");

        return [
            "status"=> "placed",
            "payment_id" => $paymentId,
            "amount" => $order["amount"]
        ];
    }

}