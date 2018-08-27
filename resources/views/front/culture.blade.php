@extends('layouts.frontend')

@section('content')
    <div class="container">
        <section class="">
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Cultura e lazer</h2>
        </section>
    
        <!--News card-->
        <div class="card mb-3 text-center hoverable wow fadeIn">
            <div class="card-body">
                <!--Grid row-->
                <div class="row">
                
                    <!--Grid column-->
                    <div class="col-md-4 offset-md-1 mx-3 my-3">
                        <!--Featured image-->
                        <div class="view overlay">
                            <img src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2016/12/unnamed1.jpg" class="img-fluid" alt="Sample image for first version of blog listing">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <!--Grid column-->
                
                    <!--Grid column-->
                    <div class="col-md-7 text-left ml-3 mt-3">
                        <h4 class="mb-4"><strong>“Correio Debate” Um debate sobe o Código Comercial</strong></h4>
                        <p>O Correio Braziliense promove, na próxima quinta-feira (15/12), a partir das 9h, no auditório do jornal, um debate sobe o Código Comercial.</p>
                        <p>Estão confirmados para o evento o deputado Paes Landim - relator do texto do projeto na Câmara-, o diretor da Associação Brasileira de Direito e Economia, Bruno Bodart, o presidente da Confederação Nacional dos Dirigentes Lojistas, Honório Pinheiro, e do secretário de Comércio e de Serviços do Ministério da Indústria, Comércio Exterior e Serviços (Mdic), Marcelo Maia.</p>
                        <p>As inscrições para o debate são gratuitas e podem ser feitas até a véspera do evento pelo correiobraziliense.com.br/correiodebate. As vagas são limitadas.</p>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
        </div>
        <!--News card-->
    
        <!--News card-->
        <div class="card mb-3 text-center hoverable wow fadeIn">
            <div class="card-body">
                <!--Grid row-->
                <div class="row">
                
                    <!--Grid column-->
                    <div class="col-md-4 offset-md-1 mx-3 my-3">
                        <!--Featured image-->
                        <div class="view overlay">
                            <img src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2016/06/unnamed-11-682x1024.jpg" class="img-fluid" alt="Sample image for first version of blog listing">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <!--Grid column-->
                
                    <!--Grid column-->
                    <div class="col-md-7 text-left ml-3 mt-3">
                        <h4 class="mb-4"><strong>“CINE PORTUGAL” CELEBRA O DIA DE PORTUGAL EM BRASÍLIA</strong></h4>
                        <p> A Casa da Cultura da América Latina, o Museu Nacional da República e o Camões – Instituto da Cooperação e da Língua no Brasil convidam para a mostra Cine Portugal.</p>
                        <p>Este ciclo de cinema integra as comemorações oficiais do Dia de Portugal, de Camões e das Comunidades Portuguesas, celebrado no dia 10 de junho.</p>
                        <p>Serão exibidos quatro filmes portugueses que reafirmam o prestígio do moderno cinema português.</p>
                        <p>Após as sessões, haverá debate com convidados do IFB - Instituto Federal de Goiás.</p>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </div>
        </div>
        <!--News card-->
    
        <div class="mb-0 mt-4">
            <nav aria-label="pagination" class="float-right">
                <ul class="pagination pagination-circle mb-0 wow fadeIn" data-wow-delay=".1s">
                    <li class="page-item disabled">
                        <a class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item">
                        <a class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    
        <div class="clearfix"></div>

    </div>
@endsection
