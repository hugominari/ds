<?php $__env->startSection('content'); ?>
	<section class="my-5">
		<div class="container">
			<h2 class="h1-responsive font-weight-bold text-left my-5">Publicações</h2>
			<div class="row">
				<?php if(!empty($pinPosts)): ?>
					<?php $__currentLoopData = $pinPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pinPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-6 col-md-12">
							<div class="single-news mb-4 wow fadeIn clickable cursor-pointer" data-href="<?php echo e(route('show.post', ['id' => $pinPost->id])); ?>">
								<div class="view overlay rounded z-depth-1-half mb-4">
									<img class="img-fluid heigth-260" src="<?php echo e($pinPost->image->url_lg); ?>"
										 alt="<?php echo e($pinPost->title); ?>">
										<div class="mask rgba-white-slight waves-effect waves-light"></div>
								</div>
								<div class="news-data d-flex justify-content-between">
									<h6 class="font-weight-bold">
										<?php echo $pinPost->tag; ?>

									</h6>
									<p class="font-weight-bold dark-grey-text">
										<i class="fa fa-clock-o pr-2"></i>
										<?php echo e($pinPost->created_at->format('d/m/Y')); ?>

									</p>
								</div>
								<h3 class="font-weight-bold dark-grey-text mb-3"><?php echo e($pinPost->title); ?></h3>
								<p class="dark-grey-text"><?php echo $pinPost->resume; ?></p>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
			
			<div class="row pt-5">
				<?php if(!empty($lastPosts)): ?>
					<?php $__currentLoopData = $lastPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="single-news mb-4 wow fadeInUp w-r-50 pr-5 clickable cursor-pointer" data-href="<?php echo e(route('show.post', ['id' => $lastPost->id])); ?>">
							<div class="row">
								<div class="col-md-3">
									<div class="view overlay rounded z-depth-1 mb-4">
										<img class="img-fluid"
											 src="<?php echo e($lastPost->image->url_sm); ?>"
											 alt="<?php echo e($lastPost->title); ?>">
										<div class="mask rgba-white-slight waves-effect waves-light"></div>
									</div>
								</div>
								<div class="col-md-9">
									<p class="font-weight-bold dark-grey-text"><?php echo e($lastPost->created_at->format('d/m/Y')); ?></p>
									<div class="d-flex justify-content-between">
										<div class="col-11 text-truncate pl-0 mb-3">
											<p><?php echo e($lastPost->title); ?></p>
											<?php echo $lastPost->resume; ?>

										</div>
										<i class="fa fa-angle-double-right"></i>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>
			
			<div class="row my-5">
				<div class="col-md-12 text-center">
					<?php echo e($lastPosts->links('vendor.pagination.material')); ?>

				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>