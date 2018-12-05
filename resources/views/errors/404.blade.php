@extends('layouts.errors')

@section('title', '404')

@section('content')
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red"> 404</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-warning text-red"></i> Oops! Página não encontrada.</h3>
				<p>A página que você está tentando acessar não existe ou foi deletada do sistema.</p>
				<p>Retorne para o sistema clicando <a href="{{ route('dashboard') }}">aqui</a>.</p>
			</div>
		</div>
	</section>
@endsection