@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-cocktail"></i> Cadastro de Evento</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('events.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => 'events.store', 'method' => 'POST', 'class' => 'ajax-form']) !!}
		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Imagem
						<p class="p-t-8 mb-0 pb-0 text-muted font-12">
							Tamanho máximo da imagem: 2000Kb<br/>
							Extensões permitidas: JPG, PNG, GIF, BMP
						</p>
					</div>
					<div class="card-body">
						{{ Form::cDropzone('image', '', '', '1', 'Selecione uma imagem', 'drop-square w-r-100') }}
 					</div>
				</div>
				<div class="card">
					<div class="card-header">
						Album
					</div>
					<div class="card-body">
						<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#addAlbum">
							Adicionar album
						</button>
					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Dados Básicos
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-12">
								{{ Form::cText('title', '', 'Titulo') }}
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-5">
								{{ Form::cDate('date', '', 'Data') }}
							</div>
							<div class="col-md-7">
								{{ Form::cText('local', '', 'Local') }}
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								{{ Form::cTextarea('description', '', 'Descrição', ['class' => 'ckeditor']) }}
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>

		<!-- Modal -->
		<div class="modal fade right" id="addAlbum" tabindex="-1" role="dialog" aria-labelledby="addAlbumLabel" aria-hidden="true">
			<div class="modal-dialog modal-frame modal-bottom modal-notify" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addAlbumLabel">Album do evento</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="box-body box-dz-multiples">
							{{ Form::cDropzone('album', '', '', '1', 'Adicionar foto', 'drop-square dz-multiple pull-left mx-1 my-1', 'image/*') }}
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Concluir</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		@component('components.fixed-actions')@endcomponent
	{!! Form::close() !!}
	
@stop

