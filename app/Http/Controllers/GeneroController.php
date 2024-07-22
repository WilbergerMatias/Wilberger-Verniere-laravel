<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:genero.index')->only('index');
        $this->middleware('can:genero.create')->only('create');
        $this->middleware('can:genero.show')->only('show');
        $this->middleware('can:genero.edit')->only('edit');
        $this->middleware('can:genero.habilitar')->only('habilitar');
        $this->middleware('can:genero.deshabilitar')->only('deshabilitar');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::index();
        return view('genero.index', compact('generos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genero.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Genero::agregarGenero($request);
        return redirect()->route('genero.index')->with('Success','Genero ha sido creado/a correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genero $genero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id=$request->Genero;
        $genero = Genero::find($id);
        return view('genero.edit',compact('genero','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Genero::editarGenero($request,$id);
        return redirect()->route('genero.index')->with('Success','Genero a sido editado/a correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

    public function habilitar(Request $request)
    {
        $validated = $request->validate([
            'Genero' => 'exists:genero,id',
        ]);
        if ($validated){
            Genero::habilitarGenero($request);
            return redirect()->route('genero.index')->with('Success','Genero ha sido habilitado/a correctamente');
        }
        return redirect()->route('genero.index')->with('Error','Genero no pudo ser habilitado/a');
    }

    public function deshabilitar(Request $request)
    {
        $validated = $request->validate([
            'Genero' => 'exists:genero,id',
        ]);
        if ($validated){
            Genero::deshabilitarGenero($request);
            return redirect()->route('genero.index')->with('Success','Genero a sido deshabilitado/a correctamente');
        }
        return redirect()->route('genero.index')->with('Error','Genero no pudo ser deshabilitado/a');
    }

    public static function nombreGenero($id)
    {
        return Genero::nombreGenero($id);
    }
    
}
