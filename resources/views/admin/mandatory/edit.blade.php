@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="{{ $icon }}"></i> Edição {{ $title }}</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('members.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => 'members.update', 'method' => 'PUT', 'class' => 'ajax-form']) !!}
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
						{{ Form::cDropzone('image', $member->image, '', '1', 'Selecione uma imagem.', 'drop-square w-r-100') }}
 					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Dados Básicos
					</div>
					<div class="card-body">
						{{ Form::cLetter('*name', $member->name, 'Nome') }}
						<div class="form-row">
							<div class="col-md-6">
								{{ Form::cCell('phone', $member->phone, 'Celular') }}
							</div>
							<div class="col-md-6">
								{{ Form::cMail('*email', $member->email, 'Email') }}
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								
								{{ Form::cDate('birth_date', $member->birth_date, 'Data de Nascimento') }}
							</div>
							<div class="col-md-6">
								{{ Form::cText('cpf', $member->cpf, 'CPF', ['class' => 'form-control cpf']) }}
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
		@component('components.fixed-actions')@endcomponent
	{!! Form::close() !!}
	
@stop

