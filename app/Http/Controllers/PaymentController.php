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

    public function getOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->getOrder($data);

        // Retornar a resposta para o cliente
        return response()->json(['message' => $response]);
    }

    public function getItemOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->getItemOrder($data);

        // Retornar a resposta para o cliente
        return response()->json(['message' => $response]);
    }

    public function closeOrder(Request $request)
    {
        // Supondo que você tenha os dados de pagamento no corpo da solicitação
        $data = $request->all();

        // Processar o pagamento usando o serviço de gateway de pagamento
        $response = $this->paymentService->closeOrder($data);

        // Retornar a resposta para o cliente
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
