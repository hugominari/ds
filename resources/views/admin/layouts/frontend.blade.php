<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sindireceita - Brasîlia/DF') }}</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
        <style type="text/css">
            @media (min-width: 800px) and (max-width: 850px) {
                .navbar:not(.top-nav-collapse) {
                    background: #1C2331!important;
                }
            }
        </style>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light lighten bg-yellow-dark scrolling-navbar">
            @include('layouts.elements.navbar')
        </nav>
        
        @if(Route::current()->getName() == 'index')
            <div class="view bg-blue-dark" style="background-image: url('{{ asset('/img/background.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
                @include('layouts.elements.intro')
            </div>
        @endif
        
        <main @if(Route::current()->getName() !== 'index') class="m-t-120" @endif>
            @yield('content')
        </main>

        <footer class="page-footer text-center font-small mt-4 wow fadeIn">
            @include('layouts.elements.footer')
        </footer>

        <script type="text/javascript" src="{{ asset('plugins/mdb/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/mdb.min.js') }}"></script>
        <script type="text/javascript">
            new WOW().init();
        </script>
    </body>
</html>
