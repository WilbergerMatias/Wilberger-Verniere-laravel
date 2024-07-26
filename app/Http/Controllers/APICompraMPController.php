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
                "transaction_amount" => (float) $body['transaction_amount'], //<TRANSACTION_AMOUNT>
                "token" => $body['token'], //<TOKEN>
                "description" => $body['description'], //<DESCRIPTION>
                "installments" => $body['installments'], //<INSTALLMENTS>
                "payment_method_id" => $body['payment_method_id'], //<PAYMENT_METHOD_ID>
                "issuer_id" => $body['issuer_id'], //<ISSUER>
                "payer" => [
                    "email" => $body['payer']['email'], //<EMAIL>
                    "identification" => [
                        "type" => $body['payer']['identification']['type'], //<IDENTIFICATION_TYPE
                        "number" => $body['payer']['identification']['number'] //<NUMBER>
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
