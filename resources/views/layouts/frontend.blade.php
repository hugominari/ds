<?php
$timestamp = microtime(false);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Sindireceita - Brasîlia/DF') }}</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/swiper/css/swiper.min.css') }}" rel="stylesheet">
{{--        <link href="{{ asset('plugins/pace/templates/pace-theme-material.tmpl.css') }}" rel="stylesheet">--}}
        <link href="{{ asset('plugins/pace/themes/custom/pace-theme-flash.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mdb.min.css?'. $timestamp) }}" rel="stylesheet">
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
    </head>
    <body data-marker="{{ asset('img/logo-marker.png') }}" data-lightbox="{{ asset('mdb-addons/mdb-lightbox-ui.html') }}">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-yellow-dark scrolling-navbar">
            @include('layouts.elements.navbar')
        </nav>
        
        @if(Route::current()->getName() == 'index')
        <div class="view bg-blue-dark" style="background-image: url('{{ asset('/img/background.jpg') }}'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; height: 100vh; z-index: 2">
            @include('layouts.elements.intro')
        </div>
        @endif

        <main @if(Route::current()->getName() !== 'index') class="m-t-120" @endif>
            @yield('content')
    
            @if(Route::current()->getName() == 'index')
                @include('layouts.elements.polls')
            @endif
        </main>

        <footer class="page-footer text-center font-small wow fadeIn pt-0 mt-5">
            @include('layouts.elements.footer')
        </footer>

        <script type="text/javascript" src="{{ asset('plugins/mdb/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/pace/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/mdb.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/swiper/js/swiper.min.js') }}"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
        <script type="text/javascript" src="{{ asset('js/custom.min.js?'. $timestamp) }}"></script>
    </body>
</html>
