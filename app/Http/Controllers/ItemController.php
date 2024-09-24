<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ItemController extends Controller
{
    // Método para exibir a lista de itens
    public function index()
    {
        return view('items.index');
    }

    // Método para exibir os detalhes de um item específico
    public function show($id)
    {
        $item = $this->findItemById($id);

        if (!$item) {
            return redirect()->route('items.index')->with('error', 'Item not found');
        }

        return view('items.show', ['item' => $item]);
    }

    // Método para comprar um item específico
    public function buy($id)
    {
        $item = $this->findItemById($id);

        if (!$item) {
            return response()->json(['error' => false, 'message' => 'Item not found'], 404);
        }

        $body = $this->buildRequestBody($item);
        $response = $this->sendPurchaseRequest($body);

        if (!$response['success']) {
            return response()->json(['error' => false, 'message' => 'Erro ao realizar a compra: ' . $response['error']], 500);
        }

        return response()->json(['success' => true, 'message' => 'Compra realizada com sucesso!', 'data' => $response['data']]);
    }

    // Método para encontrar um item pelo ID
    private function findItemById($id)
    {
        $items = View::shared('items');
        return collect($items)->firstWhere('id', $id);
    }

    // Método para construir o corpo da requisição de compra
    private function buildRequestBody($item)
    {
        
        $endpoint = env('ULTRAHOOK_ENDPOINT');

        return [
            "reference_id" => "ex-00001",
            "customer" => [
                "name" => "Name example",
                "email" => "email@test.com",
                "tax_id" => "12345678909",
                "phones" => [
                    [
                        "country" => "55",
                        "area" => "11",
                        "number" => "999999999",
                        "type" => "MOBILE"
                    ]
                ]
            ],
            "items" => [
                [
                    "name" => $item['name'],
                    "quantity" => 1,
                    "unit_amount" => $item['price']
                ]
            ],
            "qr_codes" => [
                [
                    "amount" => [
                        "value" => $item['price']
                    ],
                    "expiration_date" => "2024-10-25T20:15:59-03:00",
                ]
            ],
            "shipping" => [
                "address" => [
                    "street" => "Avenida Brigadeiro Faria Lima",
                    "number" => "1384",
                    "complement" => "apto 12",
                    "locality" => "Pinheiros",
                    "city" => "São Paulo",
                    "region_code" => "SP",
                    "country" => "BRA",
                    "postal_code" => "01452002"
                ]
            ],
            "notification_urls" => [
                $endpoint
            ]
        ];
    }

    // Método para enviar a requisição de compra à API PagSeguro
    private function sendPurchaseRequest($body)
    {
        $endpoint = env('PAGSEGURO_ENDPOINT');
        $token = env('PAGSEGURO_TOKEN');

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $endpoint);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_CAINFO, storage_path('certificates/cacert.pem'));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return ['success' => false, 'error' => $error];
        }

        $data = json_decode($response, true);
        return ['success' => true, 'data' => $data];
    }
}
