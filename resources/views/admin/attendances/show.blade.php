@extends('layouts.admin.default')

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="far fa-comment"></i> Detalhes do contato</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('contacts.index') }}" class="display-inline-block pull-right m-t-11">
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
						Dados do usuário
					</div>
					<div class="card-body">
						{{ Form::cText('name', $contact->name, 'Nome') }}
						{{ Form::cMail('email', $contact->email, 'Email') }}
						{{ Form::cPhone('phone', $contact->phone, 'Telefone') }}
 					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Mensagem
					</div>
					<div class="card-body">
						{{ Form::cText('subject', $contact->subject, 'Assunto') }}
						{{ Form::cTextarea('text', $contact->text, 'Texto') }}
					</div>
				</div>
		    </div>
		</div>
	{!! Form::close() !!}
	
@stop

