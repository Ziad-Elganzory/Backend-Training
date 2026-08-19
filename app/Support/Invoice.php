<?php

namespace App\Support;

class Invoice
{
    /**
     * @param list<array{name: string, price: float, qty: int, line_total: float}> $items
     */
    public function __construct(
        public string $customer,
        public array $items,
        public float $subtotal,
        public float $discount,
        public float $tax,
        public float $total,
        public ?string $notes = null
    ){}
}