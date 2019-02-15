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
				<h1><i class="fas fa-chair"></i> Cadastro de Mandato</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('mandatory.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => 'mandatory.store', 'method' => 'POST', 'class' => 'ajax-form']) !!}
	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Configurações
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							{{ Form::cText('name', '', 'Identificação') }}
						</div>
						<div class="col-md-4">
							{{ Form::cDate('date_start', '', 'Data de início') }}
						</div>
						<div class="col-md-4">
							{{ Form::cDate('date_end', '', 'Data de término') }}
						</div>
					</div>
					<div class="row hide">
						<div class="col-md-12">
							{{ Form::cText('directors', '', '', ['class' => 'hide']) }}
							{{ Form::cText('fiscals', '', '', ['class' => 'hide']) }}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Membros <span class="text-info font-14 d-block">Arraste a imagem do membro para os cargos abaixo:</span>
							</h4>
						</div>
					</div>
					<div class="row">
						<div id="box-members" class="col-md-12 connectedSortable" style="min-height: 30px">
							@if (!empty($members))
								@foreach($members as $member)
									<img class="width-72 heigth-72 float-left mx-2 my-2 z-depth-1"
										 src="{{ $member->image->url_sm }}" alt="{{ $member->name }}"
										 data-member="{{ $member->id }}" data-container="body" data-toggle="popover"
										 data-placement="top" data-content="{{ $member->name }}">
								@endforeach
							@endif
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
								@if (!empty($positionsDirectors))
									@foreach($positionsDirectors as $positionDirector)
										<div class="col-md-4" data-position="{{ $positionDirector->id }}">
											<p>{{ $positionDirector->name }}</p>
											<div class="connectedSortable w-r-100 h-r-100"></div>
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
							<ul class="list-unstyled sort-alpha"></ul>
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
											<div class="connectedSortable w-r-100 h-r-100"></div>
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
							<ul class="list-unstyled sort-alpha"></ul>
						</div>
					</div>
				</div>
			</div>
		
		</div>
	</div>
	
	@component('components.fixed-actions')@endcomponent
	
	{!! Form::close() !!}

@stop

