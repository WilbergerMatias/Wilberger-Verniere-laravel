<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetallesCompra;
use App\Models\Funcion;

class DetallesCompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:orden.index')->only('ordenesAsociadas');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $idCompra)
    {
        DetallesCompra::agregarDetallesCompra($request, $idCompra);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DetallesCompra::quitarDetallesCompra($request);
    }

    public function ordenesAsociadas(Request $request)
    {
        $ordenes = DetallesCompra::index($request);
        return view('detallesCompra.adminIndex', compact('ordenes')); 
    }

    public static function nombrePeliculaFuncionAsociada(int $idFuncion)
    {
        return Funcion::find($idFuncion)->pelicula->nombre;
    }

    public static function salaFuncionAsociada(int $idFuncion)
    {
        $funcion = Funcion::find($idFuncion);
        return $funcion->idSala;
    }

    public static function fechaFuncionAsociada(int $idFuncion)
    {
        $funcion = Funcion::find($idFuncion);
        return $funcion->fecha;
    }

    public static function horaFuncionAsociada(int $idFuncion)
    {
        $funcion = Funcion::find($idFuncion);
        return $funcion->hora;
    }
}
