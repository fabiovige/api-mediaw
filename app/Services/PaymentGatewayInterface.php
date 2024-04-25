<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function listOrders($data);
    public function createOrder($data);
    public function getOrder(string $order_id);
    public function getItemOrder($data);
    public function closeOrder(string $order_id);
    public function addItemOrder($data);
}
