@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-share-alt-square"></i> Cadastro de Rede Social</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('socials.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => 'socials.store', 'method' => 'POST', 'class' => 'ajax-form']) !!}
		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						{{ Form::cSelect('icon', '', 'Icone', $socials) }}
					</div>
					<div class="card-body box-icon text-center">
						
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
								{{ Form::cText('name', '', 'Nome') }}
							</div>
							<div class="col-md-6">
								{{ Form::cText('url', '', 'Url (Site)') }}
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
		@component('components.fixed-actions')@endcomponent
	{!! Form::close() !!}
	
@stop

