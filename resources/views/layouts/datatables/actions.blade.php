<!-- Split button -->
<div class="btn-group pull-right">
	<button type="button" class="btn btn-info" href='{{ $actions['show'] }}' data-id="{{ $data->id }}">
		<i class="fa fa-eye pr-2"></i> Ver
	</button>
	<button type="button" class="btn btn-info dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true"
			aria-expanded="false">
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<div class="dropdown-menu dropdown-menu-right">
		@if(($havePermission->edit || $havePermission->both)  && isset($actions['edit']) )
			<a class="dropdown-item js-edit" href="{{ $actions['edit'] }}" data-id="{{ $data->id }}" title="Editar"><i class="fa fa-edit pr-2"></i>Editar</a>
		@endif
		
		@if(($havePermission->delete || $havePermission->both) && isset($actions['delete']) )
			<a class="dropdown-item js-delete" href="{{ $actions['delete'] }}" data-id="{{ $data->id }}" title="Deletar"><i class="fa fa-trash-o pr-2"></i> Deletar</a>
		@endif
	</div>
</div>