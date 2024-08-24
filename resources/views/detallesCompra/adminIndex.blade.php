@extends('master')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ordenes asociadas:</h2>
            </div>
        </div>
    </div>
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID:</th>
                <th>Funcion ID:</th>
                <th>Pelicula:</th>
                <th>Sala:</th>
                <th>Fecha:</th>
                <th>Hora:</th>
                <th>Tickets:</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ordenes as $ord)
                <tr>
                    <td>{{ $ord->id }}</td>
                    <td>{{ $ord->idFuncion }}</td>
                    <td>{{ App\Http\Controllers\DetallesCompraController::nombrePeliculaFuncionAsociada($ord->idFuncion) }}</td>
                    <td>{{ App\Http\Controllers\DetallesCompraController::salaFuncionAsociada($ord->idFuncion) }}</td>
                    <td>{{ App\Http\Controllers\DetallesCompraController::fechaFuncionAsociada($ord->idFuncion) }}</td>
                    <td>{{ App\Http\Controllers\DetallesCompraController::horaFuncionAsociada($ord->idFuncion) }}</td> 
                    <td>{{ $ord->cantidadTickets }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $ordenes->links() !!}
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
@stop