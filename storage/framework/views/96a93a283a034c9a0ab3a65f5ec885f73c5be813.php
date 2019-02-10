<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fas fa-users"></i> Visualização de Membro</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('members.index')); ?>" class="display-inline-block pull-right m-t-11">
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
						Imagem
						<p class="p-t-8 mb-0 pb-0 text-muted font-12">
							Tamanho máximo da imagem: 2000Kb<br/>
							Extensões permitidas: JPG, PNG, GIF, BMP
						</p>
					</div>
					<div class="card-body">
						<?php echo e(Form::cDropzone('image', $member->image, '', '1', 'Selecione uma imagem.', 'drop-square w-r-100 disabled')); ?>

 					</div>
				</div>
		    </div>
		    <div class="col-md-8">
				<div class="card">
					<div class="card-header">
						Dados Básicos
					</div>
					<div class="card-body">
						<?php echo e(Form::cText('*name', $member->name, 'Nome')); ?>

						<div class="form-row">
							<div class="col-md-6">
								<?php echo e(Form::cCell('phone', $member->phone, 'Celular')); ?>

							</div>
							<div class="col-md-6">
								<?php echo e(Form::cMail('*email', $member->email, 'Email')); ?>

							</div>
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<?php if(!empty($member->birth_date)): ?>
									<?php echo e(Form::cDate('birth_date', $member->birth_date->format('d/m/Y'), 'Data de Nascimento')); ?>

								<?php else: ?>
									<?php echo e(Form::cDate('birth_date', null, 'Data de Nascimento')); ?>

								<?php endif; ?>
							</div>
							<div class="col-md-6">
								<?php echo e(Form::cText('cpf', $member->cpf, 'CPF', ['class' => 'form-control cpf'])); ?>

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