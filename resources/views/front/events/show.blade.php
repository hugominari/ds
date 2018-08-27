@extends('layouts.frontend')

@section('content')
    <div class="container">
        <section class="my-5">
            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Evento: Title of the news</h2>
            <!-- Grid row -->
    
            <div class="light-font">
                <ol class="breadcrumb blue-grey lighten-4">
                    <li class="breadcrumb-item"><a class="black-text" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a class="black-text" href="{{ route('events') }}">Eventos</a></li>
                    <li class="breadcrumb-item active">Title of the news</li>
                </ol>
            </div>
            
        </section>
        
        <!--First row-->
        <div class="row m-t--35">
        
            <!--First column-->
            <div class="col-md-12">
            
                <div id="mdb-lightbox-ui"></div>
            
                <!--Full width lightbox-->
                <div class="mdb-lightbox">
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(63).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(63).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(66).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(66).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(65).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(65).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(67).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(68).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(68).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(64).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(64).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(69).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(69).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(59).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(59).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
                
                    <figure class="col-md-4">
                        <a href="https://mdbootstrap.com/img/Mockups/Lightbox/Original/img%20(70).jpg" data-size="1600x1067">
                            <img src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(70).jpg" class="img-fluid z-depth-1">
                        </a>
                    </figure>
            
                </div>
        
            </div>
    
        </div>
        <!--First row-->
    </div>

    
@endsection
