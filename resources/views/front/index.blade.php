@extends('layouts.frontend.default')
@section('content')
	
	<div class="container">
		
		{{--Last Post--}}
		<section class="mt-5 wow fadeIn magazine-section my-5">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					@if(!empty($pinPost))
						<div class="single-news mb-lg-0 mb-4 clickable cursor-pointer" data-href="{{ route('show.post', ['id' => $pinPost->id]) }}">
							<div class="view overlay rounded z-depth-1-half mb-4 heigth-250">
								<img class="img-fluid obj-fit" src="{{ $pinPost->image->url_lg }}"
									 alt="{{ $pinPost->title }}">
								
								<div class="mask rgba-white-slight waves-effect waves-light"></div>
							</div>
							<div class="news-data d-flex justify-content-between">
								<h6 class="font-weight-bold">{!! $pinPost->tag !!}</h6>
								<p class="font-weight-bold dark-grey-text"><i
											class="fa fa-clock-o pr-2"></i>{{ $pinPost->created_at->format('d/m/Y') }}
								</p>
							</div>
							<h3 class="font-weight-bold dark-grey-text mb-3"><a>{{ $pinPost->title }}</a></h3>
							<p class="dark-grey-text mb-lg-0 mb-md-5 mb-4">{!! $pinPost->resume !!}</p>
						</div>
					@endif
				</div>
				<div class="col-lg-6 col-md-12">
					@if(!empty($lastPosts))
						@foreach($lastPosts as $lastPost)
							<div class="single-news mb-4 clickable cursor-pointer" data-href="{{ route('show.post', ['id' => $lastPost->id]) }}">
								<div class="row">
									<div class="col-md-3">
										<div class="view overlay rounded z-depth-1 mb-4 heigth-110">
											<img class="img-fluid obj-fit" src="{{ $lastPost->image->url_sm }}"
												 alt="{{ $lastPost->title }}">
												<div class="mask rgba-white-slight waves-effect waves-light"></div>
										</div>
									</div>
									<div class="col-md-9">
										<p class="font-weight-bold dark-grey-text">{{ $lastPost->created_at->format('d/m/Y') }}</p>
										<div class="d-flex justify-content-between">
											<div class="col-11 text-truncate pl-0 mb-3">
												<p>{{ $lastPost->title }}</p>
												{!! $lastPost->resume !!}
											</div>
											
											<i class="fa fa-angle-double-right"></i>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
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
                            <span class="badge bg-yellow-dark">
                                <i class="fas fa-rss mr-1"></i>Outras publicações
                            </span>
						</div>
					</div>
					@if(!empty($lastPosts))
						@foreach($lastPosts as $lastPost)
							<div class="single-news mb-3 clickable cursor-pointer" data-href="{{ route('show.post', ['id' => $lastPost->id]) }}">
								<div class="d-flex justify-content-between">
									<div class="col-11 text-truncate pl-0 mb-3">
										<small class="font-12">{{ $lastPost->created_at->format('d/m/Y') }}</small> - {{ $lastPost->title }}
									</div>
									<i class="fa fa-angle-double-right"></i>
								</div>
							</div>
						@endforeach
					@endif
				</div>
				<div class="col"></div>
				<div class="col-md-5 wow fadeInRight">
					<div class="feed">
						@if(!empty($feeds))
							@foreach($feeds as $feed)
								<div class="single-news mb-3">
									<div class="row mb-3">
										<div class="col-12">
											<span class="badge bg-blue">
												<i class="fas fa-rss mr-1"></i>
												{{ $feed->name }}
											</span>
										</div>
									</div>
								</div>
								{!! $feed->getFeed() !!}
							@endforeach
						@endif
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
						<a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-left"><i
									class="fa fa-chevron-left"></i></a>
						<a class="btn-floating bg-yellow-dark darken-4 mr-0 swiper-campaings-right"><i
									class="fa fa-chevron-right"></i></a>
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
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_convencao.gif"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_projeto_receita.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_educacao_fiscal.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_ecac.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_pirataria.jpg"
											 alt="Card image cap">
										<a href="#!">
											<div class="mask rgba-white-slight"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="swiper-slide d-flex justify-content-center">
								<div class="card card-cascade wider">
									<div class="view view-cascade overlay">
										<img class="card-img-top img-fluid"
											 src="http://www.sindireceita-df.org.br/site/wp-content/uploads/2009/05/banner_movimento_brasil.jpg"
											 alt="Card image cap">
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
					<a class="nav-link active" data-toggle="tab" href="#sites-util" role="tab"><i
								class="fas fa-link pr-1"></i> Sites Úteis</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#sites-educativos" role="tab"><i
								class="fas fa-book-open pr-1"></i> Sites Educativos</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in show active text-left" id="sites-util" role="tabpanel">
					<br>
					<div class="row">
						@if(!empty($sitesUteis))
							@foreach($sitesUteis as $siteUtil)
								<div class="col-sm-12 col-md-6">
									<a href="{{ $siteUtil->url }}" class="btn btn-link waves-effect waves-ripple"
									   target="_blank">
										{{ $siteUtil->name }}
									</a>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="tab-pane fade" id="sites-educativos" role="tabpanel">
					<br>
					<div class="row">
						@if(!empty($sitesEducatives))
							@foreach($sitesEducatives as $siteEducativo)
								<div class="col-sm-12 col-md-6">
									<a href="{{ $siteEducativo->url }}" class="btn btn-link waves-effect waves-ripple"
									   target="_blank">
										{{ $siteEducativo->name }}
									</a>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</section>
	
	</div>

@endsection
