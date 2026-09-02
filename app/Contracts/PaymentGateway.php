<?php

namespace App\Contracts;

interface PaymentGateway
{
	/**
	 * @return array{payment_id: string, status: string, amount: float, currency: string}
	 */
	public function charge(string $customerId, float $amount, string $currency): array;
}