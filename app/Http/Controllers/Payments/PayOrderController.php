<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;


use App\Billing\Order\OrderDetails;
use App\Billing\PaymentGatewayContract;
use App\Http\Controllers\Controller;


final class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway): void
    {
        $orderDetails->processOrder();

        $paymentGateway->setDiscount(10);
        $paymentGateway->charge(5000);
    }
}