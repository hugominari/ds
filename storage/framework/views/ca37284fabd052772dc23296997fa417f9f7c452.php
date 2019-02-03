<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="">
            <div class="light-font">
                <ol class="breadcrumb blue-grey lighten-4">
                    <li class="breadcrumb-item"><a class="black-text" href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="breadcrumb-item"><a class="black-text" href="<?php echo e(route('posts')); ?>">Postagens</a></li>
                    <li class="breadcrumb-item active"><?php echo e($post->title); ?></li>
                </ol>
            </div>
        </section>
        
        <section class="my-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-cascade wider reverse">
                        <div class="view view-cascade overlay heigth-400">
                            <img class="card-img-top obj-fit" src="<?php echo e($post->image->url); ?>" alt="<?php echo e($post->title); ?>">
                            <div class="mask rgba-white-slight"></div>
                        </div>
                        <div class="card-body card-body-cascade text-center">
                            <h2 class="font-weight-bold"><a><?php echo e($post->title); ?></a></h2>
                            <p><?php echo e($post->created_at->format('d/m/Y')); ?></p>
                        </div>
                    </div>
                    <div class="mt-5 text-content">
                       <?php echo $post->description; ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>