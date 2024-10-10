<?php

namespace App\Billing\Order;

use App\Billing\PaymentGatewayContract;
use Illuminate\Http\Request;

class OrderDetails
{
    private PaymentGatewayContract $paymentGateway;
    private array $orderItems;

    public function __construct(Request $request, PaymentGatewayContract $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
        $this->request = $request;
        $this->orderItems = $request->input('order_items');
    }

    public function processOrder(): void
    {
        $this->paymentGateway->setDiscount(50); //test
        $this->paymentGateway->setItems($this->orderItems);
    }
}