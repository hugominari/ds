@extends('layouts.errors')

@section('title', '500')

@section('content')
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red"> 500</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-warning text-red"></i> Oops! Erro no servidor.</h3>
				<p>Uma condição inesperada foi encontrada enquanto o servidor tentava atender o pedido.</p>
				<p>Retorne para o sistema clicando <a href="{{ route('dashboard' )}}">aqui</a>.</p>
			</div>
		</div>
	</section>
@endsection