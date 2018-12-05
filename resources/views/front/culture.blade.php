@extends('layouts.frontend.default')
@section('content')
    <div class="container">
        <section class="">
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Cultura e lazer</h2>
        </section>
        
        @if(!empty($cultures))
            @foreach($cultures as $culture)
                <div class="card mb-3 text-center hoverable wow fadeIn">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 offset-md-1 mx-3 my-3">
                                <div class="view overlay">
                                    <img src="{{ $culture->image->url_lg }}" class="img-fluid" alt="{{ $culture->title }}">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 text-left ml-3 mt-3">
                                <h4 class="mb-4"><strong>{{ $culture->title }}</strong></h4>
                                {!! $culture->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        
        {{ $cultures->links('vendor.pagination.material') }}
    
        <div class="clearfix"></div>

    </div>
@endsection
