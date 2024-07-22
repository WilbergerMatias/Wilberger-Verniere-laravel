<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sala;

class SalaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:sala.index')->only('index');
        $this->middleware('can:sala.create')->only('create');
        $this->middleware('can:sala.show')->only('show');
        $this->middleware('can:sala.edit')->only('edit');
        $this->middleware('can:sala.habilitar')->only('habilitar');
        $this->middleware('can:sala.deshabilitar')->only('deshabilitar');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::index();
        return view('sala.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sala.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Sala::agregarSala($request);
        return redirect()->route('sala.index')->with('Success','Sala ha sido creado/a correctamente.');
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
    public function edit(Request $request)
    {
        $id=$request->Sala;
        $sala = Sala::find($id);
        return view('sala.edit',compact('sala','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Sala::editarSala($request,$id);
        return redirect()->route('sala.index')->with('Success','Sala a sido editado/a correctamente');
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
            'Sala'=>'exists:sala,id',
        ]);
        if($validated){
            Sala::habilitarSala($request);
            return redirect()->route('sala.index')->with('Success','Sala ha sido habilitado/a correctamente');
        }
        return redirect()->route('sala.index')->with('Error','Sala no pudo ser habilitado/a');
    }

    public function deshabilitar(Request $request)
    {
        $validated = $request->validate([
            'Sala' => 'exists:sala,id',
        ]);
        if ($validated){
            Sala::deshabilitarSala($request);
            return redirect()->route('sala.index')->with('Success','Sala a sido deshabilitado/a correctamente');
        }
        return redirect()->route('sala.index')->with('Error','Sala no pudo ser deshabilitado/a');
    }
}
