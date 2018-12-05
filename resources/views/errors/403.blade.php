@extends('layouts.errors')

@section('title', '403')

@section('content')
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red"> 403</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-hand-paper-o text-red"></i> Oops! Acesso negado.</h3>
				<p>Você não tem permissão para acessar o conteúdo desta página.</p>
				<p>Retorne para o sistema clicando <a href="{{ route('dashboard') }}">aqui</a>.</p>
			</div>
		</div>
	</section>
@endsection