<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function listOrders($data);
    public function createOrder(array $data);
    public function getOrder(string $order_id);
    public function getItemOrder(array $data);
    public function closeOrder(array $data, string $order_id);
    public function addItemOrder(array $data, string $order_id);
}
