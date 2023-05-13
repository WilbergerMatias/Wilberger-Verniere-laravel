<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Peliculas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Peliculas</h2>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('pelicula.create') }}">Añadir Pelicula</a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID:</th>
                        <th>Nombre:</th>
                        <th>Genero ID:</th>
                        <th>Hablitado:</th>
                        <th>Accion:</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peliculas as $pel)
                        <tr>
                            <td>{{ $pel->id }}</td>
                            <td>{{ $pel->nombre }}</td>
                            <td>{{ $pel->idGenero }}</td>
                            <td>
                                @if ($pel->habilitado) {{ 'SI' }} 
                                @else {{ 'NO' }} 
                                @endif 
                            </td>
                            <td> 
                            @if($pel->habilitado)
                                <form action="{{ route('pelicula.destroy',$pel->id) }}" method="Post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                                    <button type="submit" class="btn btn-danger">Deshabilitar</button>
                                </form>
                            @else
                                <form action="{{ route('pelicula.update',$pel->id) }}" method="Post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="Pelicula" value="{{ $pel->id }}">
                                    <button type="submit" class="btn btn-primary">Habilitar</button>
                                </form>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $peliculas->links() !!}
        </div>
    </body>
</html>