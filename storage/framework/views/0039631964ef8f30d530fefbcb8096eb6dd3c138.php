<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-gavel"></i> Regimento Interno</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('dashboard')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['route' => 'rules.save', 'method' => 'POST', 'class' => 'ajax-form']); ?>

		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Download
					</div>
					<div class="card-body">
						<?php echo e(Form::cDropzone('file', $rule->file, '', '1', 'Selecione o PDF', 'drop-square w-r-100', '.pdf')); ?>

						<a class="btn bg-yellow-dark btn-block" href="<?php echo e(($rule->file->url ?? 'javascript:;')); ?>" target="_blank">Ver PDF</a>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Descrição
					</div>
					<div class="card-body">
						<?php echo e(Form::cTextarea('text', $rule->text, 'Descrição', ['class' => 'ckeditor'])); ?>

					</div>
				</div>
			</div>
		</div>
		<?php $__env->startComponent('components.fixed-actions'); ?><?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>