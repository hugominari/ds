@extends('layouts.frontend.default')
@section('content')
	<section class="my-5">
		<div class="container">
			<h2 class="h1-responsive font-weight-bold text-left my-5">Publicações</h2>
			<div class="row">
				@if(!empty($pinPosts))
					@foreach($pinPosts as $pinPost)
						<div class="col-lg-6 col-md-12">
							<div class="single-news mb-4 wow fadeIn clickable cursor-pointer" data-href="{{ route('show.post', ['id' => $pinPost->id]) }}">
								<div class="view overlay rounded z-depth-1-half mb-4 heigth-260">
									<img class="img-fluid obj-fit" src="{{ $pinPost->image->url_lg }}"
										 alt="{{ $pinPost->title }}">
										<div class="mask rgba-white-slight waves-effect waves-light"></div>
								</div>
								<div class="news-data d-flex justify-content-between">
									<h6 class="font-weight-bold">
										{!! $pinPost->tag !!}
									</h6>
									<p class="font-weight-bold dark-grey-text">
										<i class="fa fa-clock-o pr-2"></i>
										{{ $pinPost->created_at->format('d/m/Y') }}
									</p>
								</div>
								<h3 class="font-weight-bold dark-grey-text mb-3">{{ $pinPost->title }}</h3>
								<p class="dark-grey-text">{!! $pinPost->resume !!}</p>
							</div>
						</div>
					@endforeach
				@endif
			</div>
			
			<div class="row pt-5">
				@if(!empty($lastPosts))
					@foreach($lastPosts as $lastPost)
						<div class="single-news mb-4 wow fadeInUp w-r-50 pr-5 clickable cursor-pointer" data-href="{{ route('show.post', ['id' => $lastPost->id]) }}">
							<div class="row">
								<div class="col-md-3">
									<div class="view overlay rounded z-depth-1 mb-4">
										<img class="img-fluid obj-fit"
											 src="{{ $lastPost->image->url_sm }}"
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
			
			<div class="row my-5">
				<div class="col-md-12 text-center">
					{{ $lastPosts->links('vendor.pagination.material') }}
				</div>
			</div>
		</div>
	</section>
@endsection