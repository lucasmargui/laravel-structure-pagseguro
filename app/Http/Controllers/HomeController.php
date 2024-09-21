<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{
    public function index(){


$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = 'token';

$body =
  [
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
        "name" => "nome do item",
        "quantity" => 1,
        "unit_amount" => 500
      ]
    ],
    "qr_codes" => [
      [
        "amount" => [
          "value" => 500
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

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_CAINFO, storage_path('certificates/cacert.pem'));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type:application/json',
    'Authorization: Bearer ' . $token
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
    var_dump($error);
    die();
    }

    $data = json_decode($response, true);

  

        return view('welcome', compact('data'));
    }
}
