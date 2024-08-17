<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Exception;

class APIOpenMovieDBController extends Controller
{
    public function infoOMDb(Request $request)
    {
        $nombre = $request->query('nombre');
        $url = 'https://www.omdbapi.com/?apikey=' . env('OPEN_MOVIE_DATABASE_API_KEY') . '&t=' . urlencode($nombre);

        $response = Http::withOptions([
            'verify' => false,
        ])->get($url);

        // Decode the response JSON
        $responseBody = $response->json();

        // Check if the response contains an error
        if (isset($responseBody['Error'])) {
            // Return a JSON response with the error message
            return response()->json([
                'error' => $responseBody['Error'],
            ], $response->status());
        }

        // Return the successful response
        return response()->json($responseBody);
    }
}
