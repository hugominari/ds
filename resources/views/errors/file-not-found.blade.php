@extends('layouts.errors')

@section('title', 'Arquivo inexistente')

@section('content')
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red">Oops!</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-warning text-red"></i> Este arquivo não existe.</h3>
				<p>O arquivo que você está tentando baixar não existe ou foi deletado.</p>
				<p>Retorne para o sistema <a href="{{ URL::previous() }}">clicando aqui</a>.</p>
			</div>
		</div>
	</section>
@endsection