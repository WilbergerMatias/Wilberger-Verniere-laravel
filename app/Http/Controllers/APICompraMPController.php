<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\SDK;


class APICompraMPController extends Controller
{
    public function compraMercadoPago(Request $request)
    {  
        SDK::setAccessToken(env('MERCADOPAGO_API_ACCESS_TOKEN'));

        $client = new PaymentClient();
        $request_options = new RequestOptions();
        $request_options->setCustomHeaders(["X-Idempotency-Key: <SOME_UNIQUE_VALUE>"]);
      
        $body = $request->json()->all();

        try {
            // Create the payment
            $payment = $client->create([
                "transaction_amount" => (float) $_POST[$body->transaction_amount], //<TRANSACTION_AMOUNT>
                "token" => $_POST[$body->token], //<TOKEN>
                "description" => $_POST['<DESCRIPTION>'], //<DESCRIPTION>
                "installments" => $_POST[$body->installments], //<INSTALLMENTS>
                "payment_method_id" => $_POST[$body->payment_method_id], //<PAYMENT_METHOD_ID>
                "issuer_id" => $_POST[$body->issuer_id], //<ISSUER>
                "payer" => [
                    "email" => $_POST[$body->payer->email], //<EMAIL>
                    "identification" => [
                    "type" => $_POST[$body->payer->identification->type], //<IDENTIFICATION_TYPE
                    "number" => $_POST[$body->payer->identification->numer] //<NUMBER>
                    ]
                ]
            ], $request_options);

            // Return the payment response as JSON
            return response()->json($payment);
        } catch (Exception $e) {
            // Log the error
            Log::error('Payment processing error: ' . $e->getMessage());
            
            // Return an error response
            return response()->json(['error' => 'Payment processing failed', 'message' => $e->getMessage()], 500);
        }
    }
}
