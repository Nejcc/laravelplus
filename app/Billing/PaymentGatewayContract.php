<?php

declare(strict_types=1);

namespace App\Billing;

interface PaymentGatewayContract
{
    public function charge(int $amountInCents): array;

    public function setDiscount(int $amountInCents): void;

    public function processPayment();
}