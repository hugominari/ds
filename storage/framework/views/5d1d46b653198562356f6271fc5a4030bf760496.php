<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="my-5 animated fadeIn">
            <h2 class="h1-responsive font-weight-bold text-left my-5">Eventos</h2>
            <div class="row">
                <?php if(!empty($last)): ?>
                    <div class="col-lg-5 col-xl-4 heigth-250">
                        <div class="view overlay rounded z-depth-1-half mb-lg-0 mb-4">
                            <img class="img-fluid heigth-250" src="<?php echo e($last->image->url_lg); ?>" alt="<?php echo e($last->title); ?>">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="font-weight-bold mb-3"><strong><?php echo e($last->title); ?></strong></h3>
                                <p class="d-block">
                                    <span class="float-left mr-3"><i class="far fa-calendar-alt"></i> <?php echo e($last->date->format('d/m/Y')); ?></p></span>
                                <span class="float-left"><i class="far fa-clock"></i> <?php echo e($last->date->format('H:i')); ?></span>
                                </p>
                               
                            </div>
                        </div>
                        <p class="dark-grey-text"><?php echo $last->resume; ?></p>
                        <a href="<?php echo e(route('show.event', ['id' => $last->id])); ?>" class="btn btn-outline-blue-grey btn-md ml-0">
                            Ler mais
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        
        <section class="magazine-section my-5">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <?php if(!empty($others)): ?>
                            <?php $__currentLoopData = $others; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-news mb-4 wow fadeInUp">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="view overlay rounded z-depth-1 mb-4">
                                                <a href="<?php echo e(route('events.show', ['id' => $other->id])); ?>">
                                                    <img class="img-fluid" src="<?php echo e($other->image->url_sm); ?>" alt="<?php echo e($other->title); ?>">
                                                    <div class="mask rgba-white-slight waves-effect waves-light"></div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <p class="font-weight-bold dark-grey-text"><?php echo e($other->date->format('d/m/Y')); ?></p>
                                            <div class="d-flex justify-content-between">
                                                <div class="col-11 text-truncate pl-0 mb-3">
                                                    <a href="<?php echo e(route('events.show', ['id' => $other->id])); ?>" class="dark-grey-text"><?php echo e($other->title); ?></a>
                                                </div>
                                                <a href="<?php echo e(route('events.show', ['id' => $other->id])); ?>"><i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
        </section>
    
        <div class="row my-5">
            <div class="col-md-12 text-center">
                <?php echo e($others->links('vendor.pagination.material')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>