<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="theme-color" content="#33b5e5">
        <title>Painel de Controle :: Sindireceita DF</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
        <?php echo $__env->yieldPushContent('styles'); ?>
        <?php echo $__env->yieldPushContent('css'); ?>
        <link href="<?php echo e(asset('css/mdb.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/styles-backend.min.css')); ?>" rel="stylesheet">
    </head>
    <body class="fixed-sn mdb-skin-custom" aria-busy="true">
        <header>
            <div id="slide-out" class="side-nav mdb-sidenav fixed" style="transform: translateX(0%);">
                <?php echo $__env->make('layouts.admin.elements.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav navbar-dark bg-dark">
                <?php echo $__env->make('layouts.admin.elements.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </nav>
        </header>
        
        <main>
            <div class="container-fluid mt-2">
                <?php echo $__env->yieldContent('content'); ?>
                <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
            </div>
        </main>

        <div id="boxAttendance">
            <?php echo $__env->make('layouts.admin.elements.create-attendance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        
        <footer>
            <?php echo $__env->make('layouts.admin.elements.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </footer>
        
        <script type="text/javascript" src="<?php echo e(asset('js/app.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/jquery-mask-plugin/jquery.mask.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/popper.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/bootstrap.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/mdb/mdb.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('plugins/jquery.blockUI.js')); ?>"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/lib.min.js')); ?>"></script>
        <?php echo $__env->yieldPushContent('js'); ?>
        <?php echo $__env->yieldPushContent('scripts'); ?>
        <script type="text/javascript" src="<?php echo e(asset('js/modules.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/scripts-backend.min.js')); ?>"></script>
        <script type="text/javascript">
            <?php echo $__env->yieldPushContent('code'); ?>
        </script>
    </body>
</html>