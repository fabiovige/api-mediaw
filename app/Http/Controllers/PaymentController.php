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
        $data = $request->all();
        $response = $this->paymentService->createOrder($data);
        return response()->json(['message' => $response]);
    }

    public function getOrder(Request $request)
    {
        $order_id = $request->order_id;
        $response = $this->paymentService->getOrder($order_id);
        return response()->json(['message' => $response]);
    }

    public function getItemOrder(Request $request)
    {
        $data = $request->all();
        $response = $this->paymentService->getItemOrder($data);
        return response()->json(['message' => $response]);
    }

    public function closeOrder(Request $request, string $order_id)
    {
        $data = $request->all();
        if($order_id === null){
            return response()->json(['error' => 'OrderId é necessário']);
        }
        $response = $this->paymentService->closeOrder($data, $order_id);
        return response()->json(['message' => $response]);
    }

    public function addItemOrder(Request $request, string $order_id)
    {
        $data = $request->all();
        $response = $this->paymentService->addItemOrder($data, $order_id);
        return response()->json(['message' => $response]);
    }
}
