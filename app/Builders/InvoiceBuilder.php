<?php

namespace App\Builders;

use App\Support\Invoice;
use InvalidArgumentException;

class InvoiceBuilder
{
    private ?string $customer = null;
    /** @var list<array{name: string, price: float, qty: int}> */
    private array $items = [];
    private float $taxPercent = 0;
    private float $discount = 0;
    private ?string $notes = null;

    public function forCustomer(string $customer) :self
    {
        $this->customer = $customer;
        return $this;
    }

    public function addItem(string $name, float $price , int $qty) :self
    {
        $this->items[] = [
            "name" => $name,
            "price" => $price,
            "qty" => $qty
        ];
        return $this;
    }

    public function withTax(float $tax) :self
    {
        $this->taxPercent = $tax;
        return $this;
    }

    public function withDiscount(float $discount) :self
    {
        $this->discount = $discount;
        return $this;
    }

    public function withNotes(string $notes) :self
    {
        $this->notes = $notes;
        return $this;
    }

    public function build():Invoice
    {
        if($this->customer === null || $this->customer === '')
        {
            throw new InvalidArgumentException("Customer is Required");
        }

        if($this->items === []){
            throw new InvalidArgumentException("Invoice must have at least one Item");
        }

        $items = [];
        $subtotal = 0.0;

        foreach($this->items as $item){
            $lineTotal = $item['price'] * $item['qty'];
            $subtotal += $lineTotal;

            $items[] = [
                ...$item,
                'line_total' => $lineTotal
            ];
        }

        $discount = min($this->discount, $subtotal);
        $taxable = $subtotal - $discount;
        $tax = $taxable * ($this->taxPercent / 100);
        $total = $taxable + $tax;

        return new Invoice(
            customer: $this->customer,
            items: $items,
            subtotal: $subtotal,
            tax: $tax,
            discount: $discount,
            total: $total,
            notes: $this->notes,
        );
    }
}