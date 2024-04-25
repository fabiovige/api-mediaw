<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class PagarmeGateway implements PaymentGatewayInterface
{
    const BASE_URL = "https://api.pagar.me/core/v5/";

    private $headers = [];

    public function __construct()
    {
        $user = auth()->user();
        $token = $user->company->company_gateways[0]->live_api_key;

        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode("$token:"),
        ];
    }

    public function listOrders($data)
    {
        try {
            $response = Http::withHeaders($this->headers)->get( self::BASE_URL . '/orders');
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao listar pedidos',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function createOrder($data){

    }

    public function getOrder(string $order_id)
    {
        try {
            $response = Http::withHeaders($this->headers)->get( self::BASE_URL . "/orders/{$order_id}");
            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao obter pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function getItemOrder($data){
        return "getItemOrder do pagamento com Pagarme: " . json_encode($data);
    }

    public function closeOrder($order_id)
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->patch( self::BASE_URL . "/orders/{$order_id}/closed", [
                    'status' => 'canceled'
                ]);

            $data = json_decode($response->getBody(), true);
            return $data;
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao fechar pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function addItemOrder($data){
        return "addItemOrder do pagamento com Pagarme: " . json_encode($data);
    }
}
