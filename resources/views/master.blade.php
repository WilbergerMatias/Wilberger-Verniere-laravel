<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://kit.fontawesome.com/0316408d22.js" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/master.css'])

        @yield('css')
        <title>WebCines</title>
    </head>

    <body>
        @show
        @vite(['resources/js/sidebar-toggle.js'])
        <div class="main">
             <!-- Sidebar -->
            <button class="sidenav-toggle "><i class="fa fa-plus icon" style="color: #ffffff;"></i></button>
            <div class="sidenav">
                @include('sidebar')
            </div>

             <!-- Page content -->
            <div class="content">
                @yield('content')
            </div>
        </div>
        @yield('scripts')
    </body>
</html>