@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="far fa-comment"></i> Detalhes do atendimento</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('attendance.index') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	{!! Form::open(['url' => 'javascript:;', 'method' => 'GET', 'class' => 'ajax-form']) !!}
		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Dados do atendimento
					</div>
					<div class="card-body">
						{{ Form::cText('name', $attendance->name, 'Nome do cliente') }}
						{{ Form::cText('cpf', $attendance->cpf, 'CPF', ['class' => 'form-control cpf']) }}
						{{ Form::cText('type_call', $attendance->type_call->name, 'Tipo de Atendimento') }}
						{{ Form::cText('date', $attendance->date->format('d/m/Y H:i:s'), 'Data do atendimento') }}
 					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Descrição
					</div>
					<div class="card-body">
						{{ Form::cTextarea('description', $attendance->description, 'Descrição', ['rows' => 2]) }}
					</div>
				</div>
		    </div>
		</div>
	{!! Form::close() !!}
	
@stop

