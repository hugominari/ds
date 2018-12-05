<?php $__env->startSection('content'); ?>

	<div class="container">
		
		<section class="title">
			<h2 class="h1-responsive font-weight-bold text-left my-5 ">Convênios</h2>
		</section>
		
		
		<section class="agreements">
			<div class="accordion md-accordion accordion-5" id="box-convenios" role="tablist" aria-multiselectable="true">
				<?php if(!empty($covenants)): ?>
					<?php $__currentLoopData = $covenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $covenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="card mb-4 wow slideInUp">
							<div class="card-header p-0 z-depth-1" role="tab" id="heading<?php echo e($covenant->id); ?>">
								<a data-toggle="collapse" data-parent="#box-convenios" href="#collapse<?php echo e($covenant->id); ?>"
								   aria-expanded="true" aria-controls="collapse<?php echo e($covenant->id); ?>">
										<span class="bg-white mr-4 m float-left black-text h-r-100 p-t-10 px-2">
											<img src="<?php echo e($covenant->image->url_sm); ?>" alt="<?php echo e($covenant->name); ?>" style="height: 46px; width: 68px">
										</span>
									
									<h4 class="text-uppercase black-text mb-0 py-3 mt-1">
										<?php echo e(strtoupper($covenant->name)); ?>

									</h4>
								</a>
							</div>
							<div id="collapse<?php echo e($covenant->id); ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo e($covenant->id); ?>" data-parent="#box-convenios">
								<div class="card-body rgba-black-slight black-text z-depth-1">
									<?php if(!empty($covenant->description)): ?>
										<?php echo $covenant->description; ?>

									<?php else: ?>
										Nenhuma descrição para este convênio.
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
			
			<?php echo e($covenants->links('vendor.pagination.material')); ?>


			<div class="clearfix"></div>
		</section>
		
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>