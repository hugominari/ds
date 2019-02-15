<?php $__env->startPush('styles'); ?>
	<?php echo e(Html::style('http://code.jquery.com/ui/1.8.24/themes/blitzer/jquery-ui.css')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
	<?php echo Html::script('https://code.jquery.com/ui/1.12.1/jquery-ui.js'); ?>

	<?php echo Html::script('js/pages/mandatory.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-chair"></i> Cadastro de Mandato</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('mandatory.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['route' => 'mandatory.store', 'method' => 'POST', 'class' => 'ajax-form']); ?>

	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					Configurações
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<?php echo e(Form::cText('name', '', 'Identificação')); ?>

						</div>
						<div class="col-md-4">
							<?php echo e(Form::cDate('date_start', '', 'Data de início')); ?>

						</div>
						<div class="col-md-4">
							<?php echo e(Form::cDate('date_end', '', 'Data de término')); ?>

						</div>
					</div>
					<div class="row hide">
						<div class="col-md-12">
							<?php echo e(Form::cText('directors', '', '', ['class' => 'hide'])); ?>

							<?php echo e(Form::cText('fiscals', '', '', ['class' => 'hide'])); ?>

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h4>Membros <span class="text-info font-14 d-block">Arraste a imagem do membro para os cargos abaixo:</span>
							</h4>
						</div>
					</div>
					<div class="row">
						<div id="box-members" class="col-md-12 connectedSortable" style="min-height: 30px">
							<?php if(!empty($members)): ?>
								<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<img class="width-72 heigth-72 float-left mx-2 my-2 z-depth-1"
										 src="<?php echo e($member->image->url_sm); ?>" alt="<?php echo e($member->name); ?>"
										 data-member="<?php echo e($member->id); ?>" data-container="body" data-toggle="popover"
										 data-placement="top" data-content="<?php echo e($member->name); ?>">
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="box-positions" class="row pt-3">
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							Diretoria
						</div>
						<div class="card-body">
							<div id="box-directors" class="row">
								<?php if(!empty($positionsDirectors)): ?>
									<?php $__currentLoopData = $positionsDirectors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $positionDirector): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-md-4" data-position="<?php echo e($positionDirector->id); ?>">
											<p><?php echo e($positionDirector->name); ?></p>
											<div class="connectedSortable w-r-100 h-r-100"></div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							Listagem
						</div>
						<div id="list-director" class="card-body">
							<ul class="list-unstyled sort-alpha"></ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							Conselho Fiscal
						</div>
						<div class="card-body">
							<div id="box-fiscals" class="row">
								<?php if(!empty($positionsFiscals)): ?>
									<?php $__currentLoopData = $positionsFiscals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $positionFiscal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="col-md-4" data-position="<?php echo e($positionFiscal->id); ?>">
											<p><?php echo e($positionFiscal->name); ?></p>
											<div class="connectedSortable w-r-100 h-r-100"></div>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							Listagem
						</div>
						<div id="list-fiscals" class="card-body">
							<ul class="list-unstyled sort-alpha"></ul>
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