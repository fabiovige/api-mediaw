<?php

namespace App\Services;

use Exception;

class PaymentGatewayService
{
    public function __construct(
        private PaymentGatewayInterface $gateway
    ){}

    public function listOrders(array $data = [])
    {
        try {
            return $this->gateway->listOrders($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function createOrder(array $data = [])
    {
        try {
            return $this->gateway->createOrder($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOrder(array $data = [])
    {
        try {
            return $this->gateway->getOrder($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getItemOrder(array $data = [])
    {
        try {
            return $this->gateway->getItemOrder($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function closeOrder(array $data, string $order_id)
    {
        try {
            return $this->gateway->closeOrder($data, $order_id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function addItemOrder(array $data, string $order_id)
    {
        try {
            return $this->gateway->addItemOrder($data, $order_id);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
