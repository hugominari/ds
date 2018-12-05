<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-share-alt-square"></i> Visualização de Rede Social</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('socials.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['url' => '', 'method' => 'GET', 'class' => 'ajax-form']); ?>

		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<?php echo e(Form::cSelect('icon', $social->icon, 'Icone', $socials)); ?>

					</div>
					<div class="card-body box-icon text-center">
						<i class="fab fa-<?php echo e($social->icon); ?> font-48"></i>
 					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Dados Básicos
					</div>
					<div class="card-body">
						<div class="form-row">
							<div class="col-md-6">
								<?php echo e(Form::cText('name', $social->name, 'Nome')); ?>

							</div>
							<div class="col-md-6">
								<?php echo e(Form::cText('url', $social->url, 'Url (Site)')); ?>

							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>