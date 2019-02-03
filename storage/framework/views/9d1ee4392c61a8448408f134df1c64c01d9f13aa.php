<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-theater-masks"></i> Visualização Cultura e Lazer</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('events.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['url' => 'javascript:;']); ?>

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
						<?php echo e(Form::cDropzone('image', $event->image, '', '1', 'Selecione uma imagem', 'drop-square w-r-100 disabled')); ?>

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
								<?php echo e(Form::cText('title', $event->title, 'Titulo')); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<?php echo e(Form::cDate('date', $event->date->format('d/m/Y'), 'Data')); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<?php echo e(Form::cTextarea('description', $event->description, 'Descrição', ['class' => 'ckeditor'])); ?>

							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	
	<?php echo Form::close(); ?>

	
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Fotos do evento
				</div>
				<div class="card-body">
					<div class="box-dz-multiples">
						<?php if(!empty($albumPhotos)): ?>
							<?php $__currentLoopData = $albumPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $albumPhoto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e(Form::cDropzone('album', $albumPhoto, '', '1', 'Adicionar foto', 'drop-square pull-left mx-1 my-1 w-r-24 disabled', 'image/*')); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							<p>Nenhuma foto foi anexada!</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>