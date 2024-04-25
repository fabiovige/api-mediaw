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
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao listar pedidos',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function createOrder(array $data = [])
    {
        try {
            $response = Http::withHeaders($this->headers)->post( self::BASE_URL . "/orders", $data);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao fechar pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
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

    public function getItemOrder(array $data = [])
    {
        $order_id = $data['order_id'];
        $item_id = $data['item_id'];
        try {
            $response = Http::withHeaders($this->headers)->get( self::BASE_URL . "/orders/{$order_id}/items/{$item_id}", $data);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao obter o item do pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function closeOrder(array $data, string $order_id)
    {
        try {
            $response = Http::withHeaders($this->headers)->patch( self::BASE_URL . "/orders/{$order_id}/closed", $data);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao fechar pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }

    public function addItemOrder(array $data, string $order_id)
    {
        try {
            $response = Http::withHeaders($this->headers)->post( self::BASE_URL . "/orders/{$order_id}/items", $data);
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            return ['data' => [
                    'message' => 'Falha ao adicionar item ao pedido',
                    'error' => $e->getMessage()
                ]
            ];
        }
    }
}
