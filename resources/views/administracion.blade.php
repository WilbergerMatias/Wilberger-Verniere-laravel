<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >        
        @vite(['resources/css/administracion.css'])
        <title>WebCines</title>
    </head>
    <body >        
        <div class="wrapper">
            <div class="item">
                <form action="{{ route('genero.index') }}" method="Post">
                    <a class="btn btn-secondary btn-generos" href="{{ route('genero.index')}}">Generos</a>
                </form>
            </div>        
            <div class="item">    
                <form action="{{ route('pelicula.index')}}" method="Post">
                    <a class="btn btn-secondary btn-peliculas" href="{{ route('pelicula.index')}}">Peliculas</a>
                </form>
            </div>
            <div class="item">
                <form action="{{ route('funcion.index')}}" method="Post">
                    <a class="btn btn-secondary btn-funciones" href="{{ route('funcion.index')}}">Funciones</a>
                </form> 
            </div>
            <div class="item">    
                <form action="{{ route('sala.index') }}" method="Post">
                    <a class="btn btn-secondary btn-salas" href="{{ route('sala.index') }}">Salas</a>
                </form> 
            </div>    
        </div>
    </body>
</html>
