<?php
$timestamp = microtime(false);
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo e(config('app.name', 'Sindireceita - Brasîlia/DF')); ?></title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/swiper/css/swiper.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('plugins/pace/themes/custom/pace-theme-flash.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/mdb.min.css?'. $timestamp)); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/styles-frontend.min.css')); ?>" rel="stylesheet">
        <link href='https://api.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
    </head>
    <body data-marker="<?php echo e(asset('img/logo-marker.png')); ?>" data-lightbox="<?php echo e(asset('mdb-addons/mdb-lightbox-ui.html')); ?>">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-yellow-dark scrolling-navbar">
            <?php echo $__env->make('layouts.frontend.elements.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </nav>
        
        <?php if(Route::current()->getName() == 'index'): ?>
        <div class="view bg-blue-dark" style="background-image: url('<?php echo e(asset('/img/background.jpg')); ?>'); background-repeat: no-repeat; background-size: cover; background-attachment: fixed; height: 100vh; z-index: 2">
            <?php echo $__env->make('layouts.frontend.elements.intro', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php endif; ?>

        <main <?php if(Route::current()->getName() !== 'index'): ?> class="m-t-120" <?php endif; ?>>
            <?php echo $__env->yieldContent('content'); ?>
    
            <?php if(Route::current()->getName() == 'index'): ?>
                <?php echo $__env->make('layouts.modal.polls', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </main>

        <footer class="page-footer text-center font-small pt-0 mt-5">
            <?php echo $__env->make('layouts.frontend.elements.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </footer>

        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/jquery-3.3.1.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/pace/pace.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/popper.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/bootstrap.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/mdb.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/swiper/js/swiper.min.js')); ?>"></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <script type="text/javascript" src="<?php echo e(asset('js/custom.min.js?'. $timestamp)); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/scripts-frontend.js')); ?>"></script>
    </body>
</html>
