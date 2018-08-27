@extends('layouts.frontend')

@section('content')
    <div class="container">
        <section class="my-5 animated fadeIn">
            <h2 class="h1-responsive font-weight-bold text-left my-5">Eventos</h2>
            <div class="row">
                <div class="col-lg-5 col-xl-4">
                    <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                        <a>
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    <h3 class="font-weight-bold mb-3"><strong>Title of the news</strong></h3>
                    <p class="dark-grey-text">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus et aut officiis debitis cum soluta nobis est eligendi placeat facere aut rerum.</p>
                    <p>by <a class="font-weight-bold">Jessica Clark</a>, 19/04/2018</p>
                    <a href="{{ route('events.show', ['id' => '2']) }}" class="btn btn-outline-blue-grey btn-md ml-0">
                        Ler mais
                    </a>
                </div>
            </div>
        </section>
        
        <section class="magazine-section my-5">
                {{--<h2 class="h1-responsive font-weight-bold text-left my-5">Outros Eventos</h2>--}}
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="single-news mb-4 wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/photo8.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">19/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                        <div class="single-news mb-4 wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/54.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">18/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Soluta nobis est eligendi optio cumque nihil impedit quo minus</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                        <div class="single-news mb-lg-0 mb-4 wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-lg-0 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/49.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">17/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-lg-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Voluptatem accusantium doloremque</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="single-news mb-4 wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/86.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">23/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Itaque earum rerum hic tenetur a sapiente delectus</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                        <div class="single-news mb-4 wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/48.jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">22/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0 mb-3">
                                            <a href="#!" class="dark-grey-text">Soluta nobis est eligendi optio cumque nihil impedit quo minus</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                        <div class="single-news wow fadeInUp">
                        
                            <!-- Grid row -->
                            <div class="row">
                            
                                <!-- Grid column -->
                                <div class="col-md-3">
                                
                                    <!--Image-->
                                    <div class="view overlay rounded z-depth-1 mb-md-0 mb-4">
                                        <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/img%20(56).jpg" alt="Sample image">
                                        <a>
                                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                        </a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                            
                                <!-- Grid column -->
                                <div class="col-md-9">
                                
                                    <!-- Excerpt -->
                                    <p class="font-weight-bold dark-grey-text">21/08/2018</p>
                                    <div class="d-flex justify-content-between">
                                        <div class="col-11 text-truncate pl-0">
                                            <a href="#!" class="dark-grey-text">Maiores alias consequatur aut perferendis</a>
                                        </div>
                                        <a href="{{ route('events.show', ['id' => '2']) }}"><i class="fa fa-angle-double-right"></i></a>
                                    </div>
                            
                                </div>
                                <!-- Grid column -->
                        
                            </div>
                            <!-- Grid row -->
                    
                        </div>
                    </div>
                </div>
        </section>
    
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <a url="#" class="btn btn-outline-blue-grey wow fadeIn" data-wow-delay=".3s">
                    <i class="fas fa-sync mr-1"></i> Carregar mais
                </a>
            </div>
        </div>
    </div>
@endsection
