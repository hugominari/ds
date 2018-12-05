<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-clipboard-list"></i> Nossa Historia</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('dashboard')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['route' => 'history.save', 'method' => 'POST', 'class' => 'ajax-form']); ?>

		<div class="row">
		    <div class="col-md-12">
				<div class="card">
					<div class="card-header">
						Descrição
					</div>
					<div class="card-body">
						<?php echo e(Form::cTextarea('text', ($history->text ?? '') , 'Descrição', ['class' => 'ckeditor'])); ?>

 					</div>
				</div>
		    </div>
		</div>
		<?php $__env->startComponent('components.fixed-actions'); ?><?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>