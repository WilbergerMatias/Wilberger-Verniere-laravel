@extends('master')
@section('content')
<div class="container mt-2">
    @include("alert")   
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Salas:</h2>
            </div>
        </div>
    </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Nombre: </th>
                    <th>Capacidad: </th>
                    <th>Habilitado: </th>
                    <th>Accion: </th>
                </tr>
            </thead>
            <tbody>
            @foreach ($salas as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nombre }}</td>
                    <td>{{ $s->capacidadMaxima }}</td>
                    <td>
                    @if ($s->habilitado) {{ 'SI' }} 
                    @else {{ 'NO' }} 
                    @endif 
                    </td>
                    <td>      
                        @if($s->habilitado)
                            @can('sala.deshabilitar')
                            <form action="{{ route('sala.deshabilitar',$s->id) }}" method="Post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="Sala" value="{{ $s->id }}">
                                <button type="submit" class="btn btn-danger">Deshabilitar</button>
                            </form>
                            @endcan  
                        @else
                            @can('sala.habilitar')
                            <form action="{{ route('sala.habilitar',$s->id) }}" method="Post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="Sala" value="{{ $s->id }}">
                                <button type="submit" class="btn btn-primary">Habilitar</button>
                            </form>
                            @endcan
                        @endif
                        @can('sala.edit')
                        <form action="{{ route('sala.edit',$s->id) }}" method="Post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="Sala" value="{{ $s->id }}">
                            <button type="submit" class="btn btn-secondary">Editar</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $salas->links() !!}
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">