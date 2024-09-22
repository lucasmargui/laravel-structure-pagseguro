<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = [
            ['id' => 1, 'name' => 'Item 1', 'price' => 100],
            ['id' => 2, 'name' => 'Item 2', 'price' => 200],
            ['id' => 3, 'name' => 'Item 3', 'price' => 300],
            ['id' => 4, 'name' => 'Item 4', 'price' => 400],
            ['id' => 5, 'name' => 'Item 5', 'price' => 500],
        ];

        return view('items.index', compact('items'));
    }

    public function show($id)
{
    // Simulando a recuperação de dados do item. Em um caso real, você buscaria no banco de dados.
    $items = [
        ['id' => 1, 'name' => 'Item 1', 'price' => 100],
        ['id' => 2, 'name' => 'Item 2', 'price' => 200],
        ['id' => 3, 'name' => 'Item 3', 'price' => 300],
        ['id' => 4, 'name' => 'Item 4', 'price' => 400],
        ['id' => 5, 'name' => 'Item 5', 'price' => 500],
    ];

    // Encontrar o item com o ID correspondente
    $item = collect($items)->firstWhere('id', $id);

    return view('items.show', compact('item'));
}

public function buy($id)
{
    // Simulando a lógica de compra, você pode obter o item real do banco de dados
    $items = [
        ['id' => 1, 'name' => 'Item 1', 'price' => 500],
        ['id' => 2, 'name' => 'Item 2', 'price' => 200],
        ['id' => 3, 'name' => 'Item 3', 'price' => 300],
        ['id' => 4, 'name' => 'Item 4', 'price' => 400],
        ['id' => 5, 'name' => 'Item 5', 'price' => 500],
    ];

    $item = collect($items)->firstWhere('id', $id);

    // Endpoint e token da API
    $endpoint = env('PAGSEGURO_ENDPOINT');
    $token = env('PAGSEGURO_TOKEN');

    // Configurando o corpo da requisição
    $body = [
        "reference_id" => "ex-00001",
        "customer" => [
            "name" => "Jose da Silva",
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
            "https://lucasmargui-webhook.ultrahook.com"
        ]
    ];

    // Configurando a requisição cURL
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

    // Executa a requisição
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    // Verifica se ocorreu algum erro
    if ($error) {
        return response()->json(['success' => false, 'message' => 'Erro ao realizar a compra: ' . $error], 500);
    }

    // Decodifica a resposta
    $data = json_decode($response, true);

    // Verifica a resposta da API e retorna como JSON
    return response()->json(['success' => true, 'message' => 'Compra realizada com sucesso!', 'data' => $data]);
}

}
