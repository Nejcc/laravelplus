<?php

namespace App\Billing;

class StripePaymentGateway implements PaymentGatewayContract
{

    public function charge(int $amountInCents): array
    {
        // TODO: Implement charge() method.
    }

    public function setDiscount(int $amountInCents): void
    {
        // TODO: Implement setDiscount() method.
    }

    public function processPayment()
    {
        // TODO: Implement processPayment() method.
    }
}