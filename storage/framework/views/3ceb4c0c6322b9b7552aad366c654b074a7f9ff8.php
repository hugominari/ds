<!-- Split button -->
<div class="btn-group pull-right">
	<button type="button" class="btn btn-info" href='<?php echo e($actions['show']); ?>' data-id="<?php echo e($data->id); ?>">
		<i class="fa fa-eye pr-2"></i> Ver
	</button>
	<button type="button" class="btn btn-info dropdown-toggle px-3" data-toggle="dropdown" aria-haspopup="true"
			aria-expanded="false">
		<span class="sr-only">Toggle Dropdown</span>
	</button>
	<div class="dropdown-menu dropdown-menu-right">
		<?php if(($havePermission->edit || $havePermission->both)  && isset($actions['edit']) ): ?>
			<a class="dropdown-item js-edit" href="<?php echo e($actions['edit']); ?>" data-id="<?php echo e($data->id); ?>" title="Editar"><i class="fa fa-edit pr-2"></i>Editar</a>
		<?php endif; ?>
		
		<?php if(($havePermission->delete || $havePermission->both) && isset($actions['delete']) ): ?>
			<a class="dropdown-item js-delete" href="<?php echo e($actions['delete']); ?>" data-id="<?php echo e($data->id); ?>" title="Deletar"><i class="fa fa-trash-o pr-2"></i> Deletar</a>
		<?php endif; ?>
	</div>
</div>