<?php

namespace Core\Application\Services;

use Core\Domain\Interfaces\PaymentGatewayInterface;
use Core\Application\DTO\Payment\OrderData;

class PaymentGatewayService
{
    public function __construct(
        private PaymentGatewayInterface $paymentGateway
    ){}

    public function listOrders(array $data)
    {
        return $this->paymentGateway->listOrders($data);
    }

    public function createOrder(array $data)
    {
        return $this->paymentGateway->createOrder($data);
    }

    public function getOrder(string $order_id)
    {
        return $this->paymentGateway->getOrder($order_id);
    }

    public function getItemOrder(array $data)
    {
        return $this->paymentGateway->getItemOrder($data);
    }

    public function closeOrder(array $data, string $order_id)
    {
        return $this->paymentGateway->closeOrder($data, $order_id);
    }

    public function addItemOrder(array $data, string $order_id)
    {
        return $this->paymentGateway->addItemOrder($data, $order_id);
    }
}
