@extends('layouts.frontend.default')
@section('content')
    <div class="container">
        <section class="my-5 text-content">
            <h2 class="h1-responsive font-weight-bold text-left">Evento: {{ $event->title }}</h2>
            
            <div class="light-font">
                <ol class="breadcrumb blue-grey lighten-4">
                    <li class="breadcrumb-item"><a class="black-text" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a class="black-text" href="{{ route('events') }}">Eventos</a></li>
                    <li class="breadcrumb-item active">{{ $event->title }}</li>
                </ol>
            </div>
            {!! $event->description !!}
        </section>
        
        <div class="row m-t--35">
            <div class="col-md-12">
                <div id="mdb-lightbox-ui"></div>
                <div class="mdb-lightbox">
                    @foreach($albums as $album)
                        <figure class="col-md-4 mb-2">
                            <a href="{{ $album->url }}" data-size="{{ $album->dimensions }}">
                                <img src="{{ $album->url_lg }}" class="img-fluid z-depth-1 heigth-300">
                            </a>
                        </figure>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
