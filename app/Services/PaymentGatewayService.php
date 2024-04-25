<?php

namespace App\Services;

use Exception;

class PaymentGatewayService
{
    protected $gateway;

    public function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function listOrders($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->listOrders($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
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

    public function getOrder($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->getOrder($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
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
