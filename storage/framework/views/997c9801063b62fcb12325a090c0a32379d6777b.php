<?php $__env->startPush('scripts'); ?>
	<?php echo Html::script('js/pages/user.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="fa fa-user"></i> Cadastro de Usuários</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('users.index')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<?php echo Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'ajax-form']); ?>

		<div class="row">
		    <div class="col-md-4">
				<div class="card">
					<div class="card-header">
						Imagem de Perfil
						<p class="p-t-8 mb-0 pb-0 text-muted font-12">
							Tamanho máximo da imagem: 2000Kb<br/>
							Extensões permitidas: JPG, PNG, GIF, BMP
						</p>
					</div>
					<div class="card-body">
						<?php echo e(Form::cDropzone('image', '', '', '1', 'Selecione uma imagem', 'drop-square w-r-100')); ?>

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
								<?php echo e(Form::cText('name', '', 'Nome')); ?>

							</div>
							<div class="col-md-6">
								<?php echo e(Form::cText('username', '', 'Nome de Usuário')); ?>

							</div>
						</div>
					
						<div class="form-row">
							<div class="col-md-6">
								<?php echo e(Form::cPassword('password', '', 'Senha')); ?>

							</div>
							<div class="col-md-6">
								<?php echo e(Form::cPassword('password_confirmation', '', 'Confirmar Senha')); ?>

							</div>
						</div>
						<div class="row">
						    <div class="col-md-12">
								<?php echo e(Form::cSelect('profile', '', 'Perfil', $profiles)); ?>

						    </div>
						</div>
					</div>
				</div>
				
				<div class="card">
					<div class="card-header">
						Permissões
					</div>
					<div class="card-body">
						<h3 class="box-title clearfix">
							<span class="float-left">Permissões</span>
							<div class="switch float-left ml-5">
								<label class="font-12">
									Marcar Todos
									<input type="checkbox" id="toggler">
									<span class="lever"></span> Desmarcar Todos
								</label>
							</div>
						</h3>
						<p class="p-t-15 text-muted"><i class="fa fa-info-circle"></i> As permissões são carregadas conforme o tipo de perfil selecionado.</p>
						<div class="form-group is-empty m-t-0">
							<input name="permissions" type="hidden" id="permissions">
						</div>
						<div class="box-body permissions-box" data-source="<?php echo e(route('users.load-permissions')); ?>">
							
							
							
							
							
							
							
							
							
							
						</div>
					</div>
				</div>
		    </div>
		</div>
		<?php $__env->startComponent('components.fixed-actions'); ?><?php echo $__env->renderComponent(); ?>
	<?php echo Form::close(); ?>

	
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>