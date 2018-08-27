@extends('layouts.frontend')

@section('content')
    <div class="container">
        <section class="my-5">
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Fale Conosco</h2>
            
            <section class="contact-section my-5 animated fadeInUp">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card-body form">
                                <h3 class="mt-4"><i class="fa fa-envelope pr-2"></i>Digite sua mensagem:</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="form-contact-name" class="form-control">
                                            <label for="form-contact-name" class="">Nome</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="form-contact-email" class="form-control">
                                            <label for="form-contact-email" class="">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="form-contact-phone" class="form-control">
                                            <label for="form-contact-phone" class="">Telefone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="form-contact-company" class="form-control">
                                            <label for="form-contact-company" class="">Assunto</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <textarea type="text" id="form-contact-message" class="form-control md-textarea" rows="3"></textarea>
                                            <label for="form-contact-message">Mensagem</label>
                                            <a class="btn-floating btn-lg blue-gradient">
                                                <i class="fa fa-send"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card-body contact text-center h-100 white-text bg-blue-dark">
                                <h3 class="my-4 pb-2">Contatos</h3>
                                <ul class="text-lg-left list-unstyled ml-4">
                                    <li>
                                        <p>
                                            <i class="fa fa-map-marker pr-2"></i>
                                            <span class="">Sindireceita - DF </span><br/>
                                            <span class="ml-4 d-block">Delegacia Sindical de Brasília </span>
                                            <span class="ml-4 d-block">Endereço: SCS Qd. 02 Bloco C </span>
                                            <span class="ml-4 d-block"> Ed: Serra Dourada | Salas 516/517 </span>
                                            <span class="ml-4 d-block"> CEP: 70.300-902</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-phone pr-2"></i>(61) 3443-2235 / 3244-8517</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-fax pr-2"></i>(61) 3443-8065</p>
                                    </li>
                                    <li>
                                        <p><i class="fa fa-envelope pr-2"></i>contato@sindireceita-df.org.br</p>
                                    </li>
                                </ul>
                                <hr class="hr-light my-4">
                                <ul class="list-inline text-center list-unstyled">
                                    <li class="list-inline-item">
                                        <a class="p-2 fa-lg tw-ic">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="p-2 fa-lg tw-ic">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="p-2 fa-lg li-ic">
                                            <i class="fa fa-youtube"> </i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="p-2 fa-lg ins-ic">
                                            <i class="fa fa-instagram"> </i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="section-map" class="wow fadeIn" data-wow-delay=".5s">
                <div id="map-container" class="z-depth-1" style="height: 480px; width:100%;"></div>
                <p class="text-center">
                    <a href="https://goo.gl/maps/NGa2hCPdyNq" class="btn btn-link" target="_blank">Abrir o mapa no google</a>
                </p>
            </section>
        </section>
    </div>
@endsection
