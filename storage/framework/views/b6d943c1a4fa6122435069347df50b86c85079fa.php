<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="">
            <h2 class="h1-responsive font-weight-bold text-left my-5 ">Cultura e lazer</h2>
        </section>
        
        <?php if(!empty($cultures)): ?>
            <?php $__currentLoopData = $cultures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $culture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3 text-center hoverable wow fadeIn">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 offset-md-1 mx-3 my-3">
                                <div class="view overlay">
                                    <img src="<?php echo e($culture->image->url_lg); ?>" class="img-fluid" alt="<?php echo e($culture->title); ?>">
                                    <a>
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 text-left ml-3 mt-3">
                                <h4 class="mb-4"><strong><?php echo e($culture->title); ?></strong></h4>
                                <?php echo $culture->description; ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        
        <?php echo e($cultures->links('vendor.pagination.material')); ?>

    
        <div class="clearfix"></div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>