<?php

namespace App\Services;

use Exception;

class MercadoPagoGateway implements PaymentGatewayInterface
{
    public function listOrders($data){
        return "ListOrders do pagamento com Pagarme: " . json_encode($data);
    }

    public function createOrder($data){
        return "createOrder do pagamento com Pagarme: " . json_encode($data);
    }

    public function getOrder($data){
        return "getOrder do pagamento com Pagarme: " . json_encode($data);
    }

    public function getItemOrder($data){
        return "getItemOrder do pagamento com Pagarme: " . json_encode($data);
    }

    public function closeOrder($data){
        return "closeOrder do pagamento com Pagarme: " . json_encode($data);
    }

    public function addItemOrder($data){
        return "addItemOrder do pagamento com Pagarme: " . json_encode($data);
    }
}
