<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Genero;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $peliculas = Pelicula::index();
        return view('pelicula.index', compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generos = Genero::where('habilitado',true)->get();
        return view('pelicula.create', compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Genero' => 'exists:genero,id',
        ]);
        if ($validated) {
            Pelicula::agregarPelicula($request);
            return redirect()->route('pelicula.index')->with('Success','Pelicula ha sido creado/a correctamente.');
        }
        return redirect()->route('pelicula.index')->with('Error','Pelicula no pudo ser creado/a.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id=$request->Pelicula;
        $pelicula = Pelicula::find($id);
        $generos = Genero::where('habilitado',true)->get();
        return view('pelicula.edit',compact('pelicula','id','generos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idGenero' => 'exists:genero,id',
        ]);
        if ($validated){
            Pelicula::editarPelicula($request,$id);
            return redirect()->route('pelicula.index')->with('Success','Pelicula a sido editado/a correctamente');
        }
        return redirect()->route('pelicula.index')->with('Error','Pelicula has not been updated successfully');
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
            'Pelicula' => 'exists:pelicula,id',
        ]);
        if ($validated){
            Pelicula::habilitarPelicula($request);
            return redirect()->route('pelicula.index')->with('Success','Pelicula ha sido habilitado/a correctamente');
        }
        return redirect()->route('pelicula.index')->with('Error','Pelicula no pudo ser habilitado/a');
    }

    public function deshabilitar(Request $request)
    {
        $validated = $request->validate([
            'Pelicula' => 'exists:pelicula,id',
        ]);
        if ($validated){
            Pelicula::deshabilitarPelicula($request);
            return redirect()->route('pelicula.index')->with('Success','Pelicula a sido deshabilitado/a correctamente');
        }
        return redirect()->route('pelicula.index')->with('Error','Pelicula no pudo ser deshabilitado/a');
    }

    public static function nombrePelicula($id)
    {
        return Pelicula::nombrePelicula($id);
    }

}
