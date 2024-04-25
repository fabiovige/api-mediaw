<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentGatewayService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentGatewayService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function listOrders(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->listOrders($data);

        // Retornar a resposta para o cliente
        return response()->json(['message' => $response]);
    }

    public function createOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->createOrder($data);

        // Retornar a resposta para o cliente
        return response()->json(['message' => $response]);
    }

    public function getOrder(string $order_id = null)
    {
        if($order_id === null){
            return response()->json(['error' => 'OrderId é necessário']);
        }
        $response = $this->paymentService->getOrder($order_id);
        return response()->json(['message' => $response]);
    }

    public function getItemOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        $response = $this->paymentService->getItemOrder($data);
        return response()->json(['message' => $response]);
    }

    public function closeOrder(string $order_id)
    {
        if($order_id === null){
            return response()->json(['error' => 'OrderId é necessário']);
        }
        $response = $this->paymentService->closeOrder($order_id);
        return response()->json(['message' => $response]);
    }

    public function addItemOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->addItemOrder($data);

        // Retornar a resposta para o cliente
        return response()->json(['message' => $response]);
    }
}
