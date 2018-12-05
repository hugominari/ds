<?php $__env->startSection('content'); ?>
	<div class="container">
		<section class="title">
			<h2 class="h1-responsive font-weight-bold text-left my-5 ">Nossa História</h2>
		</section>
		
		<section class="content">
			<?php echo $content; ?>

		</section>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>