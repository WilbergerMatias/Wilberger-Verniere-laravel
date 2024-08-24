<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Exception;

class APIOpenAIController extends Controller
{
    public function infoChatGPT(Request $request)
    {
        $consulta = $request->query('consulta');
        
        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $consulta],
            ],
            'max_tokens' => 250,
        ]);

        // Decode the response JSON
        $responseBody = $response->json();

        // Check if the response contains an error
        if (isset($responseBody['error'])) {
            // Return a JSON response with the error message
            return response()->json([
                'error' => $responseBody['error']['message'] ?? 'Unknown error occurred',
            ], $response->status());
        }

        return response()->json($responseBody);
    }
}
