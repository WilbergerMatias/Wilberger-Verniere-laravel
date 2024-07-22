@extends('master')
@section('content')
<div class="container mt-2">
    @include("alert")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Peliculas:</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID:</th>
                <th>Nombre:</th>
                <th>Genero:</th>
                <th>Habilitado:</th>
                <th>Accion:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peliculas as $pel)
                <tr>
                    <td>{{ $pel->id }}</td>
                    <td>{{ $pel->nombre }}</td>
                    <td>{{ App\Http\Controllers\GeneroController::nombreGenero($pel->idGenero) }}</td>
                    <td>
                        @if ($pel->habilitado) {{ 'SI' }} 
                        @else {{ 'NO' }} 
                        @endif 
                    </td>
                    <td> 
                        @if($pel->habilitado)
                            @can('pelicula.deshabilitar')
                            <form action="{{ route('pelicula.deshabilitar',$pel->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                                <button type="submit" class="btn btn-danger">Deshabilitar</button>
                            </form>
                            @endcan
                        @else
                            @can('pelicula.habilitar')
                            <form action="{{ route('pelicula.habilitar',$pel->id) }}" method="Post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                                <button type="submit" class="btn btn-primary">Habilitar</button>
                            </form>
                            @endcan
                        @endif
                        @can('pelicula.edit')
                        <form action="{{ route('pelicula.edit',$pel->id) }}" method="Post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                            <button type="submit" class="btn btn-secondary">Editar</button>
                        </form>
                        @endcan
                        @can('pelicula.showImage')
                        <form action="{{ route('pelicula.show',$pel->id) }}" method="Post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                            <button type="submit" class="btn btn-secondary">Ver portada</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $peliculas->links() !!}
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">