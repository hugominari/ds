@extends('layouts.errors')

@section('title', '403')

@section('content')
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red"> 401</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-hand-paper-o text-red"></i> Oops! Voce precisa autenticar no seu email.</h3>
				</a>
				<p>Retorne para o <a href="{{route('logout')}}" >login</a> aqui.</p>
			</div>
		</div>
	</section>
@endsection