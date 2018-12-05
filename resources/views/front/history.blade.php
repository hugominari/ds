@extends('layouts.frontend.default')
@section('content')
	<div class="container">
		<section class="title">
			<h2 class="h1-responsive font-weight-bold text-left my-5 ">Nossa História</h2>
		</section>
		
		<section class="content">
			{!! $content !!}
		</section>
	</div>
@endsection