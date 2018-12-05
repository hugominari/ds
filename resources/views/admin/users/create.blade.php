@extends('layouts.admin.default')

@push('scripts')
	{!! Html::script('js/pages/user.min.js') !!}
@endpush

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fa fa-user"></i> Cadastro de Usuários</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('users.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'ajax-form']) !!}
		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Imagem de Perfil
						<p class="p-t-8 mb-0 pb-0 text-muted font-12">
							Tamanho máximo da imagem: 2000Kb<br/>
							Extensões permitidas: JPG, PNG, GIF, BMP
						</p>
					</div>
					<div class="card-body">
						{{ Form::cDropzone('image', '', '', '1', 'Selecione uma imagem', 'drop-square w-r-100') }}
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
								{{ Form::cText('username', '', 'Nome de Usuário') }}
							</div>
						</div>
					
						<div class="form-row">
							<div class="col-md-6">
								{{ Form::cPassword('password', '', 'Senha') }}
							</div>
							<div class="col-md-6">
								{{ Form::cPassword('password_confirmation', '', 'Confirmar Senha') }}
							</div>
						</div>
						<div class="row">
						    <div class="col-md-12">
								{{ Form::cSelect('profile', '', 'Perfil', $profiles) }}
						    </div>
						</div>
					</div>
				</div>
				
				<div class="card">
					<div class="card-header">
						Permissões
					</div>
					<div class="card-body">
						<h3 class="box-title">Permissões</h3>
						<p class="p-t-15 text-muted"><i class="fa fa-info-circle"></i> As permissões são carregadas conforme o tipo de perfil selecionado.</p>
						<div class="form-group is-empty m-t-0">
							<input name="permissions" type="hidden" id="permissions">
						</div>
						<div class="box-body permissions-box" data-source="{{ route('users.load-permissions') }}">
							{{--@if(!empty($permissions))--}}
							{{--@foreach($permissions as $permission)--}}
							{{--<div class="switch w-r-45 float-left">--}}
							{{--<label>--}}
							{{--<input type="checkbox" name="permissions[]" id="perm{{ $permission->id }}" value="">--}}
							{{--<span class="lever"></span> {{ $permission->permission->display_name }}--}}
							{{--</label>--}}
							{{--</div>--}}
							{{--@endforeach--}}
							{{--@endif--}}
						</div>
					</div>
				</div>
		    </div>
		</div>
		@component('components.fixed-actions')@endcomponent
	{!! Form::close() !!}
	
@stop

