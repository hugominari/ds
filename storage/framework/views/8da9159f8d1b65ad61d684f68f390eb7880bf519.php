<?php $__env->startPush('styles'); ?>
	<?php echo e(Html::style('plugins/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css')); ?>

	<?php echo e(Html::style('css/addons/datatables.min.css')); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
	<?php echo Html::script('plugins/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<section class="content-header">
		<div class="row m-b-10">
			<div class="col-md-8">
				<h1><i class="far fa-comment"></i> Fale Conosco</h1>
			</div>
			<div class="col-md-4">
				<a href="<?php echo e(route('dashboard')); ?>" class="display-inline-block pull-right m-t-11">
					<button class="btn btn-white"><i class="fa fa-arrow-circle-left m-r-5"></i> Voltar</button>
				</a>
			</div>
		</div>
	</section>
	
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-striped" cellspacing="0" width="100%" data-source="<?php echo e(route('contacts.list')); ?>" data-type="datatables">
							<thead>
								<tr>
									<th data-slug="status" class="no-sort">Lido</th>
									<th data-slug="name" class="th-sm sort default-sort">Nome</th>
									<th data-slug="email" class="th-sm">Email</th>
									<th data-slug="phone" class="th-sm">Telefone</th>
									<th data-slug="subject" class="th-sm">Assunto</th>
									<th data-slug="created_at" class="th-sm">Data</th>
									<th data-slug="action" class="th-sm no-sort width-150">Ações</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>