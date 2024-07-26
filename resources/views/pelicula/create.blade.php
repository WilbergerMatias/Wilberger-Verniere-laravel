@extends('master')
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mb-2">
                <h2>Añadir nueva pelicula:</h2>
            </div>
        </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('pelicula.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="Nombre" class="form-control" placeholder="Ej: Star Wars" required>
                    @error('Nombre')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label>Genero:</label>
                <select name="Genero" id="gen" placeholder="Elija una opcion" required>
                    @foreach ($generos as $gen)
                        <option value="{{$gen->id}}"> {{ $gen->nombre }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                    <label>Adjuntar Imagen:</label>
                    <input type="file" name="Imagen_pelicula" id="img_pel">
            </div>
        </div>
        <a class="btn btn-danger" href="{{ route('pelicula.index') }}">Back</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@stop

@section('css')
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
@stop