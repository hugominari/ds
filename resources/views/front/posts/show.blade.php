@extends('layouts.frontend.default')
@section('content')
    <div class="container">
        <section class="">
            <div class="light-font">
                <ol class="breadcrumb blue-grey lighten-4">
                    <li class="breadcrumb-item"><a class="black-text" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a class="black-text" href="{{ route('posts') }}">Postagens</a></li>
                    <li class="breadcrumb-item active">{{ $post->title }}</li>
                </ol>
            </div>
        </section>
        
        <section class="my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-cascade wider reverse">
                        <div class="view view-cascade overlay heigth-400">
                            <img class="card-img-top obj-fit" src="{{ $post->image->url }}" alt="{{ $post->title }}">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                            <h2 class="font-weight-bold"><a>{{ $post->title }}</a></h2>
                            <p>{{ $post->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-5">
                       {!! $post->description !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
