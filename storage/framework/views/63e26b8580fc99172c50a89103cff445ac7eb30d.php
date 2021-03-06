<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fa fa-newspaper"></i> Edição de Publicação</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('posts.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['route' => ['posts.update', $post->id], 'method' => 'PUT', 'class' => 'ajax-form']); ?>

		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Imagem
						<p class="p-t-8 mb-0 pb-0 text-muted font-12">
							Tamanho máximo da imagem: 2000Kb<br/>
							Extensões permitidas: JPG, PNG, GIF, BMP
						</p>
					</div>
					<div class="card-body">
						<?php echo e(Form::cDropzone('image', $post->image, '', '1', 'Selecione uma imagem', 'drop-square w-r-100')); ?>

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
							<div class="col-md-12">
								<?php echo e(Form::cText('title', $post->title, 'Titulo')); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<?php echo e(Form::cTextarea('description', $post->description, 'Descrição', ['class' => 'ckeditor'])); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="col-md-5">
								<?php echo e(Form::cSelect('type', $post->type, 'Tipo', $types)); ?>

							</div>
							<div class="col-md-7">
								<?php echo e(Form::cText('source', $post->source, 'Fonte')); ?>

							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
		<?php $__env->startComponent('components.fixed-actions'); ?><?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>