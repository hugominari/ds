@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-hands-helping"></i> Edição de Convênio</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('covenants.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => ['covenants.update', $covenant->id], 'method' => 'PUT', 'class' => 'ajax-form']) !!}
		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Logomarca
					</div>
					<div class="card-body box-icon text-center">
						{{ Form::cDropzone('image', $covenant->image, '', '1', 'Selecione uma imagem', 'drop-square w-r-100') }}
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
							<div class="col-md-6">
								{{ Form::cText('name', $covenant->name, 'Nome') }}
							</div>
							<div class="col-md-6">
								{{ Form::cText('url', $covenant->url, 'Url (Site)') }}
							</div>
						</div>
						{{ Form::cTextarea('description', $covenant->description, 'Descrição', ['class' => 'ckeditor']) }}
					</div>
				</div>
		    </div>
		</div>
		@component('components.fixed-actions')@endcomponent
	{!! Form::close() !!}
	
@stop

