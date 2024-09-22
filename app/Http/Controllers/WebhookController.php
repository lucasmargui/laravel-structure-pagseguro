<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\ConsoleOutput;

class WebhookController extends Controller

    // Array para armazenar as requisições recebidas
{



    // Método que receberá as notificações do webhook
    public function handleWebhook(Request $request)
    {
        // Registra a requisição recebida no log
        Log::info('Webhook received:', $request->all());

        // Retorne uma resposta para confirmar que o webhook foi recebido
        return response()->json(['status' => 'success'], 200);
    }
    
}