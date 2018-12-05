<div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
	<div class="btn-group mr-2" role="group" aria-label="First group">
	<?php if(($havePermission->edit || $havePermission->both)  && isset($actions['edit']) ): ?>
		
			<a href='<?php echo e($actions['edit']); ?>' role="button" class="btn btn-info btn-sm js-edit-basic text-white" title="Editar">
				<i class="fa fa-edit font-16"></i>
			</a>
		
	<?php endif; ?>
	<?php if(($havePermission->delete || $havePermission->both) && isset($actions['delete']) ): ?>
		
			<a href='<?php echo e($actions['delete']); ?>' class="btn btn-danger btn-sm js-delete text-white" title="Deletar">
				<i class="fa fa-trash font-16"></i>
			</a>
		
	<?php endif; ?>
	</div>
</div>