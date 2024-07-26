@extends('master')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Editar funcion:</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('funcion.update',$id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Pelicula:</label>
            <select name="Pelicula" id="pel" value="{{ $funcion->idPelicula }}" required>
                @foreach ($peliculas as $pel)
                    <option value="{{$pel->id}}"> {{ $pel->nombre }} </option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Sala:</label>
            <select name="Sala" id="s" value="{{ $funcion->idSala }}" required>
                @foreach ($salas as $s)
                    <option value="{{$s->id}}"> {{ $s->id }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Fecha:</label>
            <input type="date" id="date" name="Fecha" value="{{ $funcion->fecha }}" required>
            <label>Hora:</label>
            <input type="time" id="date" name="Hora" min="08:00" max="24:00" value="{{ App\Http\Controllers\FuncionController::formatoFechaSinSegundos($funcion->hora) }}" required>
        </div>
        <a class="btn btn-danger" href="{{ route('funcion.index') }}">Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
@stop