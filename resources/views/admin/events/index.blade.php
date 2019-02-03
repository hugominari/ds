@extends('layouts.admin.default')

@push('styles')
	{{ Html::style('plugins/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}
@endpush

@push('scripts')
	{!! Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') !!}
@endpush

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-cocktail"></i> Eventos</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('events.create') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-plus-circle m-r-5"></i> Nova</button>
				</a>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-striped" cellspacing="0" width="100%" data-source="{{ route('events.list') }}" data-type="datatables">
							<thead>
								<tr>
									<th data-slug="image" class="th-xs no-sort no-filter width-48">Imagem</th>
									<th data-slug="title" class="th-sm sort default-sort">Titulo</th>
									<th data-slug="local" class="th-sm">Local</th>
									<th data-slug="date" class="th-sm">Data</th>
									<th data-slug="action" class="th-sm no-sort width-150">Ações</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection