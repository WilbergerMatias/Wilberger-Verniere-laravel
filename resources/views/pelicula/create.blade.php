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
                    <div class="input-group">
                        <input type="text" id="nombrePelicula" name="Nombre" class="form-control" placeholder="Ej: Star Wars" required>
                        <button type="button" id="fillFormBtn" class="btn btn-secondary">Llenar formulario</button>
                    </div>
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
                <div id="errorGenero" class="alert alert-danger mt-1 mb-1" style="display:none;">
                    El genero de esta pelicula en OMDb no existe en la lista de generos existentes
                </div>
            </div>
            <div class="form-group">
                <label>Adjuntar Imagen:</label>
                <input type="file" name="Imagen_pelicula" id="img_pel">
                <div id="imagenPreview"></div>
                <div id="errorPoster" class="alert alert-danger mt-1 mb-1" style="display:none;">
                    El genero de esta pelicula en OMDb no existe en la lista de generos existentes
                </div>
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

@section('scripts')
<script>
    document.getElementById('fillFormBtn').addEventListener('click', function() {
        let nombrePelicula = document.getElementById('nombrePelicula').value;
        let apiKey = @json($apiKey);

        if (nombrePelicula) {
            let nombreFormateado = nombrePelicula.replace(/\s/g, '+')
            fetch(`https://www.omdbapi.com/?apikey=${apiKey}&t=${nombreFormateado}`)
                .then(response=>{
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.Response === "False") {
                        alert("No existe esa pelicula en OMDb");
                    }
                    else{
                        setGenero(data);
                        setPoster(data);
                        alert("Se autocompleto el formulario con datos obtenidos de OMDb");
                    }
                })
                .catch(error => console.error('Error al obtener datos de OMDb:', error));
        } else {
            alert('Por favor, ingrese un nombre de película');
        }
    });

    function setGenero(data){
        let generoOMDb = data.Genre.split(',');
        let listaGenerosExistentes = @json($generos);
        let encontrado = false;

        for (let i=0; !encontrado && i<listaGenerosExistentes.length; i++){
            for (let j=0; !encontrado && j<generoOMDb.length; j++){
                if (generoOMDb[j].trim().toLowerCase() === listaGenerosExistentes[i].nombre.trim().toLowerCase()){
                    document.getElementById('gen').value = listaGenerosExistentes[i].id;
                    encontrado = true;
                }
            }
        }

        if (!encontrado) {
            document.getElementById('errorGenero').style.display = 'block';
        } else {
            document.getElementById('errorGenero').style.display = 'none';
        }
    }   

    function setPoster(data){
        var posterOMDb = data.Poster; console.log(posterOMDb);

        if (posterOMDb && posterOMDb != 'N/A'){
            var imagenElement = document.createElement('img');
            imagenElement.src = posterOMDb;
            imagenElement.alt = 'Poster';
            imagenElement.style.maxWidth = '300px';
            imagenElement.style.maxHeight = '300px';

            imagenPreview.innerHTML = '';
            imagenPreview.appendChild(imagenElement);

            var imagenText = document.createElement('a');
            imagenText.textContent = 'Para setear esta imagen como poster debe descargarla y adjuntarla al formulario';
            imagenPreview.appendChild(imagenText)

            var linkDescarga = document.createElement('a');
            linkDescarga.href = posterOMDb;
            linkDescarga.download = 'poster.jpg';
            linkDescarga.textContent = 'Descargar Poster';
            imagenPreview.appendChild(linkDescarga);
        }

    }
</script>
@stop