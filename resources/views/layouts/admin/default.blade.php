<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#33b5e5">
        <title>Painel de Controle :: Sindireceita DF</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        @stack('styles')
        @stack('css')
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles-backend.min.css') }}" rel="stylesheet">
    </head>
    <body class="fixed-sn mdb-skin-custom" aria-busy="true">
        <header>
            <div id="slide-out" class="side-nav mdb-sidenav fixed" style="transform: translateX(0%);">
                @include('layouts.admin.elements.sidebar')
            </div>
            <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav navbar-dark bg-dark">
                @include('layouts.admin.elements.navbar')
            </nav>
        </header>
        
        <main>
            <div class="container-fluid mt-2">
                @yield('content')
                @routes
            </div>
        </main>

        <div id="boxAttendance">
            @include('layouts.admin.elements.create-attendance')
        </div>
        
        <footer>
            @include('layouts.admin.elements.footer')
        </footer>
        
        <script type="text/javascript" src="{{ asset('js/app.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/jquery-mask-plugin/jquery.mask.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/popper.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/mdb/mdb.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('plugins/jquery.blockUI.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/lib.min.js') }}"></script>
        @stack('js')
        @stack('scripts')
        <script type="text/javascript" src="{{ asset('js/modules.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/scripts-backend.min.js') }}"></script>
        <script type="text/javascript">
            @stack('code')
        </script>
    </body>
</html>