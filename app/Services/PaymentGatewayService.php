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

    public function createOrder($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->createOrder($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
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

    public function getItemOrder($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->getItemOrder($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
            return $e->getMessage();
        }
    }

    public function closeOrder($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->closeOrder($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
            return $e->getMessage();
        }
    }

    public function addItemOrder($data)
    {
        try {
            // Lógica para processar o pagamento usando o gateway específico
            return $this->gateway->addItemOrder($data);
        } catch (Exception $e) {
            // Lidar com erros de processamento de pagamento
            return $e->getMessage();
        }
    }
}
