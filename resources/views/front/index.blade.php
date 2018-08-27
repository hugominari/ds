@extends('layouts.frontend')

@section('content')
    
    <div class="container">
        
        {{--Last Post--}}
        <section class="mt-5 wow fadeIn magazine-section my-5">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="single-news mb-lg-0 mb-4">
                        <div class="view overlay rounded z-depth-1-half mb-4">
                            <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Slides/1.jpg" alt="Sample image">
                            <a>
                                <div class="mask rgba-white-slight waves-effect waves-light"></div>
                            </a>
                        </div>
                        <div class="news-data d-flex justify-content-between">
                            <a href="#!" class="deep-orange-text"><h6 class="font-weight-bold"><i class="fa fa-cutlery pr-2"></i>Culinary</h6></a>
                            <p class="font-weight-bold dark-grey-text"><i class="fa fa-clock-o pr-2"></i>27/02/2018</p>
                        </div>
                        <h3 class="font-weight-bold dark-grey-text mb-3"><a>Title of the news</a></h3>
                        <p class="dark-grey-text mb-lg-0 mb-md-5 mb-4">Sed ut perspiciatis unde voluptatem omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae explicabo. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="single-news mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view overlay rounded z-depth-1 mb-4">
                                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(29).jpg" alt="Sample image">
                                    <a>
                                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="font-weight-bold dark-grey-text">26/02/2018</p>
                                <div class="d-flex justify-content-between">
                                    <div class="col-11 text-truncate pl-0 mb-3">
                                        <a href="#!" class="dark-grey-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</a>
                                    </div>
                                    <a><i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-news mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view overlay rounded z-depth-1 mb-4">
                                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(45).jpg" alt="Sample image">
                                    <a>
                                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="font-weight-bold dark-grey-text">25/02/2018</p>
                                <div class="d-flex justify-content-between">
                                    <div class="col-11 text-truncate pl-0 mb-3">
                                        <a href="#!" class="dark-grey-text">Itaque earum rerum hic tenetur a sapiente delectus</a>
                                    </div>
                                    <a><i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-news mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view overlay rounded z-depth-1 mb-4">
                                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/images/87.jpg" alt="Sample image">
                                    <a>
                                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="font-weight-bold dark-grey-text">24/02/2018</p>
                                <div class="d-flex justify-content-between">
                                    <div class="col-11 text-truncate pl-0 mb-3">
                                        <a href="#!" class="dark-grey-text">Soluta nobis est eligendi optio cumque nihil impedit quo minus</a>
                                    </div>
                                    <a><i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-news">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="view overlay rounded z-depth-1 mb-md-0 mb-4">
                                    <img class="img-fluid" src="https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg" alt="Sample image">
                                    <a>
                                        <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="font-weight-bold dark-grey-text">23/02/2018</p>
                                <div class="d-flex justify-content-between">
                                    <div class="col-11 text-truncate pl-0 mb-lg-3">
                                        <a href="#!" class="dark-grey-text">Duis aute irure dolor in reprehenderit in voluptate</a>
                                    </div>
                                    <a><i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="my-5 wow slideInRight">
        
        {{--Posts--}}
        <section id="widget-all-posts" class="my-5">
            <div class="row">
                <div class="col-md-6 wow fadeInLeft">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="#!">
                            <span class="badge bg-yellow-dark">
                                <i class="fas fa-rss mr-1"></i>Outras publicações
                            </span>
                            </a>
                        </div>
                    </div>
            
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="single-news mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="col-11 text-truncate pl-0 mb-3">
                                <a>24 Food Swaps That Slash Calories.</a>
                            </div>
                            <a><i class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-md-5 wow fadeInRight">
                    <div class="feed">
                        <div class="single-news mb-3">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="#!"><span class="badge bg-blue"><i class="fas fa-rss mr-1"></i>G1 economia</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="feed">
                        <div class="single-news mb-3">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="#!"><span class="badge bg-blue"><i class="fas fa-rss mr-1"></i>Folha de São Paulo</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="feed">
                        <div class="single-news mb-3">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <a href="#!"><span class="badge bg-blue"><i class="fas fa-rss mr-1"></i>Estadão</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="single-news mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="col-11 text-truncate pl-0 mb-3">
                                    <a>24 Food Swaps That Slash Calories.</a>
                                </div>
                                <a><i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <hr class="my-5 wow slideInRight">
        
        {{--Campanha--}}
        <section id="widget-campaigns" class="my-5 wow fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h1-responsive font-weight-bold float-left pt-3">Campanhas</h2>
                    <div class="controls-top float-right">
                        <a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-left"><i class="fa fa-chevron-left"></i></a>
                        <a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-right"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row py-4">
                <div class="col-md-12">
                    <div class="swiper-container campaigns">
                        <div class="swiper-wrapper my-3">
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_convencao.gif" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_projeto_receita.jpg" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_educacao_fiscal.jpg" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_ecac.jpg" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_pirataria.jpg" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide d-flex justify-content-center">
                                <div class="card card-cascade wider">
                                    <div class="view view-cascade overlay">
                                        <img class="card-img-top img-fluid" src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_movimento_brasil.jpg" alt="Card image cap">
                                        <a href="#!">
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   
        </section>
        
        {{--Sites--}}
        <section id="widget-sites" class="my-5 wow fadeIn">
            <ul class="nav nav-tabs md-tabs nav-justified bg-gray w-r-100 mx-auto" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel5" role="tab"><i class="fas fa-link pr-1"></i> Sites Úteis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel6" role="tab"><i class="fas fa-book-open pr-1"></i> Sites Educativos</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in show active text-left" id="panel5" role="tabpanel">
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Receita Federal</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Mistério da Fazenda</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Presidência da República</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Senado Federal</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Câmara dos Deputados</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Supremo Tribunal Federal</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Câmara Legislativa do Distrito Federal</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Imprensa Nacional</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Sindireceita</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Unareceita</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Ceds-MG</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Portal Siape net</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Fundação Assefaz</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Credfaz</a></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="panel6" role="tabpanel">
                    <br>
                    <div class="row">
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Instituto Camões</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Instituto Cervantes</a></div>
                        <div class="w-100"></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Istituto Dante Alighieri</a></div>
                        <div class="col-sm-12 col-md-6"><a href="#!" class="btn btn-link waves-effect waves-ripple">Memória da Receita Federal</a></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </section>
        
    </div>

@endsection
