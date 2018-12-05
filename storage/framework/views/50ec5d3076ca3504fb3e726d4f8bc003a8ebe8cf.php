<?php $__env->startSection('title', '404'); ?>

<?php $__env->startSection('content'); ?>
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-red"> 404</h2>
			<div class="error-content text-center">
				<h3><i class="fa fa-warning text-red"></i> Oops! Página não encontrada.</h3>
				<p>A página que você está tentando acessar não existe ou foi deletada do sistema.</p>
				<p>Retorne para o sistema clicando <a href="<?php echo e(route('dashboard')); ?>">aqui</a>.</p>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>