<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="my-5 text-content">
            <h2 class="h1-responsive font-weight-bold text-left">Evento: <?php echo e($event->title); ?></h2>
            
            <div class="light-font">
                <ol class="breadcrumb blue-grey lighten-4">
                    <li class="breadcrumb-item"><a class="black-text" href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a class="black-text" href="<?php echo e(route('events')); ?>">Eventos</a></li>
                    <li class="breadcrumb-item active"><?php echo e($event->title); ?></li>
                </ol>
            </div>
            <?php echo $event->description; ?>

        </section>
        
        <div class="row m-t--35">
            <div class="col-md-12">
                <div id="mdb-lightbox-ui"></div>
                <div class="mdb-lightbox">
                    <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <figure class="col-md-4 mb-2">
                            <a href="<?php echo e($album->url); ?>" data-size="<?php echo e($album->dimensions); ?>">
                                <img src="<?php echo e($album->url_lg); ?>" class="img-fluid z-depth-1 heigth-300">
                            </a>
                        </figure>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>