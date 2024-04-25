<?php

namespace App\Services;

interface PaymentGatewayInterface
{
    public function listOrders($data);
    public function createOrder($data);
    public function getOrder($data);
    public function getItemOrder($data);
    public function closeOrder($data);
    public function addItemOrder($data);
}
