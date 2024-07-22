<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\DetallesCompra;
use App\Http\DetallesCompraController;

class CompraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:compra.index')->only('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::index();
        return view('compra.adminIndex', compact('compras'));
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
    public function store(Request $request)
    {
        Compra::agregarCompra($request);
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
        Compra::quitarCompra($request);
    }
}
