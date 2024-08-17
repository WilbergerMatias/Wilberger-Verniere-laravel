<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APICompraController;
use App\Http\Controllers\APIDetallesCompraController;
use App\Http\Controllers\APIFuncionController;
use App\Http\Controllers\APIGeneroController;
use App\Http\Controllers\APIPeliculaController;
use App\Http\Controllers\APIUsuarioController;
use App\Http\Controllers\APICompraMPController;
use App\Http\Controllers\APIOpenAIController;
use App\Http\Controllers\APIOpenMovieDBController;
use App\Http\Controllers\Auth\AuthControllerApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request){
        $user = $request->user();
        $nombre = $user->name;
        $email = $user->email;

        return response()->json([
            'Nombre' => $nombre,
            'Email' => $email,
        ]);
    });
    Route::post('/logout', [AuthControllerApi::class, 'logout']);

    Route::get('/compras', [APICompraController::class, 'index']);
    Route::get('/compras/asociadas', [APICompraController::class, 'indexWithEmail']);
    Route::get('/compras/{idCompra}', [APICompraController::class, 'show']);
    Route::post('/compras/crear', [APICompraController::class, 'store']);
    Route::delete('/compras/eliminar', [APICompraController::class, 'destroy']);

    Route::get('/detallesCompras/{idDetallesCompra}', [APIDetallesCompraController::class, 'show']);

    Route::post('/process_payment', [APICompraMPController::class, 'compraMercadoPago']);
});

Route::post('/login', [AuthControllerApi::class, 'login']);
Route::post('/register', [AuthControllerApi::class, 'register']);
Route::post('/usuarios/iniciar', [APIUsuarioController::class, 'getWithEmail']);


Route::get('/generos', [APIGeneroController::class, 'index']);
Route::get('/generos/{idGenero}', [APIGeneroController::class, 'show']);

Route::get('/peliculas', [APIPeliculaController::class, 'index']);
Route::get('/peliculas/{idPelicula}', [APIPeliculaController::class, 'show']);

Route::get('/funciones', [APIFuncionController::class, 'index']);
Route::get('/funciones/asociadas', [APIFuncionController::class, 'indexWithPelicula']);
Route::get('/funciones/{idFuncion}', [APIFuncionController::class, 'show']);

Route::get('/chatgpt', [APIOpenAIController::class, 'infoChatGPT']);
Route::get('/openmovie', [APIOpenMovieDBController::class, 'infoOMDb']);