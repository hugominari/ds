@extends('layouts.admin.default')

@push('styles')
	{{ Html::style('http://code.jquery.com/ui/1.8.24/themes/blitzer/jquery-ui.css') }}
@endpush

@push('scripts')
	{!! Html::script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') !!}
	{!! Html::script('js/pages/mandatory.min.js') !!}
@endpush

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-chair"></i> Visualização de Mandato</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('mandatory.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['url' => 'javascript:;']) !!}
	
	<div class="row">
		<div class="col-md-12">
			
			<div class="card">
				<div class="card-header">
					Configurações
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							{{ Form::cText('name', $mandatory->name, 'Identificação') }}
						</div>
						<div class="col-md-4">
							{{ Form::cDate('date_start', $mandatory->date_start->format('d/m/Y'), 'Data de início') }}
						</div>
						<div class="col-md-4">
							{{ Form::cDate('date_end', $mandatory->date_end->format('d/m/Y'), 'Data de término') }}
						</div>
					</div>
				</div>
			</div>
			
			<div id="box-positions" class="row pt-3">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							Diretoria
						</div>
						<div class="card-body">
							<div id="box-directors" class="row">
								{{--								{{ dd($directors) }}--}}
								@if (!empty($positionsDirectors))
									@foreach($positionsDirectors as $positionDirector)
										<div class="col-md-4" data-position="{{ $positionDirector->id }}">
											<p>{{ $positionDirector->name }}</p>
											<div class="connectedSortable w-r-100 h-r-100 text-center">
												<img class="img-fluid width-72 heigth-72 float-left mx-2 my-2 z-depth-1"
													 src="{{ $directors[$positionDirector->id]['image'] }}"
													 alt="{{ $directors[$positionDirector->id]['name'] }}" data-member="{{ $directors[$positionDirector->id]['id'] }}">
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							Listagem
						</div>
						<div id="list-director" class="card-body">
							@if (!empty($positionsDirectors))
								@foreach($positionsDirectors as $positionDirector)
									<p id="{{ $directors[$positionDirector->id]['id'] }}-{{ $positionDirector->id }}"><b> {{ $positionDirector->name }} </b> <br />é ocupado por <b> {{ $directors[$positionDirector->id]['name'] }} </b></p>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							Conselho Fiscal
						</div>
						<div class="card-body">
							<div id="box-fiscals" class="row">
								@if (!empty($positionsFiscals))
									@foreach($positionsFiscals as $positionFiscal)
										<div class="col-md-4" data-position="{{ $positionFiscal->id }}">
											<p>{{ $positionFiscal->name }}</p>
											<div class="connectedSortable w-r-100 h-r-100">
												<img class="img-fluid width-72 heigth-72 float-left mx-2 my-2 z-depth-1"
													 src="{{ $fiscals[$positionFiscal->id]['image'] }}"
													 alt="{{ $fiscals[$positionFiscal->id]['name'] }}" data-member="{{ $fiscals[$positionFiscal->id]['id'] }}">
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							Listagem
						</div>
						<div id="list-fiscals" class="card-body">
							@if (!empty($positionsFiscals))
								@foreach($positionsFiscals as $positionFiscal)
									<p id="{{ $fiscals[$positionFiscal->id]['id'] }}-{{ $positionFiscal->id }}"><b> {{ $positionFiscal->name }} </b> <br />é ocupado por <b> {{ $fiscals[$positionFiscal->id]['name'] }} </b></p>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	{!! Form::close() !!}

@stop

