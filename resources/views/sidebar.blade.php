<a href="{{ url('/') }}">
    <i class="fa-solid fa-home" style="color: #ffffff;"></i>
    Inicio
</a>

<div class="btn-group">
    <a class="elem" href="{{ route('funcion.index') }}">Funciones</a>
    @can('funcion.create')
    <a class="añadir" href="{{ route('funcion.create') }}">+</a>
    @endcan
</div>

<div class="btn-group">
    <a class="elem" href="{{ route('pelicula.index') }}">Peliculas</a>
    @can('pelicula.create')
    <a class="añadir" href="{{ route('pelicula.create') }}">+</a>
    @endcan
</div> 

<div class="btn-group">
    <a class="elem" href="{{ route('genero.index') }}">Generos</a>
    @can('genero.create')
    <a class="añadir" href="{{ route('genero.create') }}">+</a>
    @endcan
</div> 

<div class="btn-group">
    <a class="elem" href="{{ route('sala.index') }}">Salas</a>
    @can('sala.create')
    <a class="añadir" href="{{ route('sala.create') }}">+</a>
    @endcan
</div>  

<div class="btn-group">
    @can('compra.index')
    <a class="elem" href="{{ route('compra.index') }}">Compras</a>
    @endcan
</div>

<a class="username">
    <div>{{ Auth::user()->name }}</div>
</a>
<a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fa-solid fa-power-off" style="color: #ffffff;"></i>
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>