@extends('master')
@section('content')
<div class="container mt-2">
    @include("alert")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Funciones:</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID:</th>
                <th>Pelicula:</th>
                <th>Sala ID:</th>
                <th>Fecha:</th>
                <th>Hora:</th>
                <th>Tickets Comprados:</th>
                <th>Habilitado:</th>
                <th>Accion:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funciones as $fun)
                <tr>
                    <td>{{ $fun->id }}</td>
                    <td>{{ App\Http\Controllers\PeliculaController::nombrePelicula($fun->idPelicula) }}</td> 
                    <td>{{ $fun->idSala }}</td>
                    <td>{{ App\Http\Controllers\FuncionController::formatoFecha($fun->fecha) }}</td>
                    <td>{{ $fun->hora }}</td>
                    <td> {{ App\Http\Controllers\FuncionController::getTicketsAsociados($fun->id) }}</td>
                    <td>
                        @if ($fun->habilitado) {{ 'SI' }} 
                        @else {{ 'NO' }} 
                        @endif 
                    </td>
                    <td>
                        @if($fun->habilitado)
                            @can('funcion.deshabilitar')
                            <form action="{{ route('funcion.deshabilitar',$fun->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="Funcion" value="{{ $fun->id }}">
                                <button type="submit" class="btn btn-danger">Deshabilitar</button>
                            </form>
                            @endcan
                        @else
                            @can('funcion.habilitar')
                            <form action="{{ route('funcion.habilitar',$fun->id) }}" method="Post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="Funcion" value="{{ $fun->id }}">
                                <button type="submit" class="btn btn-primary">Habilitar</button>
                            </form>
                            @endcan
                        @endif
                        @can('funcion.edit')
                        <form action="{{ route('funcion.edit',$fun->id) }}" method="Post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="Funcion" value="{{ $fun->id }}">
                            <button type="submit" class="btn btn-secondary">Editar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $funciones->links() !!}
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">