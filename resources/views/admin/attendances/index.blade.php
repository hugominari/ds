@extends('layouts.admin.default')

@push('styles')
	{{ Html::style('plugins/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}
	{{ Html::style('css/addons/datatables.min.css') }}
@endpush

@push('scripts')
	{!! Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') !!}
@endpush

@section('content')
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-headset"></i> Atendimento</h1>
			</div>
			<div class="col-md-4">
				<a href="{{ route('dashboard') }}" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-striped" cellspacing="0" width="100%" data-source="{{ route('attendance.list') }}" data-type="datatables">
							<thead>
								<tr>
									<th data-slug="name" class="th-sm sort default-sort">Nome</th>
									<th data-slug="cpf" class="th-sm">CPF</th>
									<th data-slug="type_call" class="th-sm">Tipo de Chamada</th>
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