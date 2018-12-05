<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-hands-helping"></i> Visualização de Convênio</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('covenants.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['url' => 'javascript:;', 'method' => 'GET', 'class' => 'ajax-form']); ?>

		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Logomarca
					</div>
					<div class="card-body box-icon text-center">
						<?php echo e(Form::cDropzone('image', $covenant->image, '', '1', 'Selecione uma imagem', 'drop-square w-r-100 disabled')); ?>

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
								<?php echo e(Form::cText('name', $covenant->name, 'Nome')); ?>

							</div>
							<div class="col-md-6">
								<?php echo e(Form::cText('url', $covenant->url, 'Url (Site)')); ?>

							</div>
						</div>
						<?php echo e(Form::cTextarea('description', $covenant->description, 'Descrição', ['class' => 'ckeditor'])); ?>

					</div>
				</div>
		    </div>
		</div>
	<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>