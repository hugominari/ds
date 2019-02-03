@extends('layouts.frontend.default')
@section('content')
    <div class="container">
        <section class="my-5 animated fadeIn">
            <h2 class="h1-responsive font-weight-bold text-left my-5">Eventos</h2>
            <div class="row">
                @if(!empty($last))
                    <div class="col-lg-5 col-xl-4 heigth-250">
                        <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                            <img class="img-fluid heigth-250" src="{{ $last->image->url_lg }}" alt="{{ $last->title }}">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="font-weight-bold mb-3"><strong>{{ $last->title }}</strong></h3>
                                <p class="d-block">
                                    <span class="float-left mr-3"><i class="far fa-calendar-alt"></i> {{ $last->date->format('d/m/Y') }}</p></span>
                                <span class="float-left"><i class="far fa-clock"></i> {{ $last->date->format('H:i') }}</span>
                                </p>
                               
                            </div>
                        </div>
                        <p class="dark-grey-text">{!! $last->resume !!}</p>
                        <a href="{{ route('show.event', ['id' => $last->id]) }}" class="btn btn-outline-blue-grey btn-md ml-0">
                            Ler mais
                        </a>
                    </div>
                @endif
            </div>
        </section>
        
        <section class="magazine-section my-5">
            <div class="row pt-5">
                @if(!empty($others))
                    @foreach($others as $other)
                        <div class="single-news mb-4 wow fadeInUp w-r-50 pr-5 clickable cursor-pointer" data-href="{{ route('show.event', ['id' => $other->id]) }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="view overlay rounded z-depth-1 mb-4">
                                        <a href="{{ route('show.event', ['id' => $other->id]) }}">
                                            <img class="img-fluid" src="{{ $other->image->url_sm }}" alt="{{ $other->title }}">
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <p class="font-weight-bold dark-grey-text">{{ $other->date->format('d/m/Y') }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-3">
                                            <a href="{{ route('show.event', ['id' => $other->id]) }}" class="dark-grey-text">{{ $other->title }}</a>
                                        </div>
                                        <a href="{{ route('show.event', ['id' => $other->id]) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    
        <div class="row my-5">
            <div class="col-md-12 text-center">
                {{ $others->links('vendor.pagination.material') }}
            </div>
        </div>
    </div>
@endsection
