@extends('master')
@section('content')
<div class="container mt-2">
    @include("alert")
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Generos:</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID:</th>
                <th>Nombre:</th>
                <th>Habilitado:</th>
                <th>Accion:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($generos as $gen)
                <tr>
                    <td>{{ $gen->id }}</td>
                    <td>{{ $gen->nombre }}</td>
                    <td>
                        @if ($gen->habilitado) {{ 'SI' }} 
                        @else {{ 'NO' }} 
                        @endif 
                    </td>
                    <td>
                        @if($gen->habilitado)
                            @can('genero.deshabilitar')
                            <form action="{{ route('genero.deshabilitar',$gen->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="Genero" value="{{ $gen->id }}">
                                <button type="submit" class="btn btn-danger">Deshabilitar</button>
                            </form>
                            @endcan
                        @else
                            @can('genero.habilitar')
                            <form action="{{ route('genero.habilitar',$gen->id) }}" method="Post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="Genero" value="{{ $gen->id }}">
                                <button type="submit" class="btn btn-primary">Habilitar</button>
                            </form>
                            @endcan
                        @endif
                        @can('genero.edit')
                        <form action="{{ route('genero.edit',$gen->id) }}" method="Post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="Genero" value="{{ $gen->id }}">
                            <button type="submit" class="btn btn-secondary">Editar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $generos->links() !!}
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">