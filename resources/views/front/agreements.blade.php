@extends('layouts.frontend.default')
@section('content')

	<div class="container">
		
		<section class="title">
			<h2 class="h1-responsive font-weight-bold text-left my-5 ">Convênios</h2>
		</section>
		
		
		<section class="agreements">
			<div class="accordion md-accordion accordion-5" id="box-convenios" role="tablist" aria-multiselectable="true">
				@if(!empty($covenants))
					@foreach($covenants as $covenant)
						<div class="card mb-4 wow slideInUp">
							<div class="card-header p-0 z-depth-1" role="tab" id="heading{{ $covenant->id }}">
								<a data-toggle="collapse" data-parent="#box-convenios" href="#collapse{{ $covenant->id }}"
								   aria-expanded="true" aria-controls="collapse{{ $covenant->id }}">
										<span class="bg-white mr-4 m float-left black-text h-r-100 p-t-10 px-2">
											<img src="{{ $covenant->image->url_sm }}" alt="{{ $covenant->name }}" style="height: 46px; width: 68px">
										</span>
									
									<h4 class="text-uppercase black-text mb-0 py-3 mt-1">
										{{ strtoupper($covenant->name) }}
									</h4>
								</a>
							</div>
							<div id="collapse{{ $covenant->id }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $covenant->id }}" data-parent="#box-convenios">
								<div class="card-body rgba-black-slight black-text z-depth-1">
									@if(!empty($covenant->description))
										{!! $covenant->description !!}
									@else
										Nenhuma descrição para este convênio.
									@endif
								</div>
							</div>
						</div>
					@endforeach
				@endif
			</div>
			
			{{ $covenants->links('vendor.pagination.material') }}

			<div class="clearfix"></div>
		</section>
		
	</div>
@endsection
