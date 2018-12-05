    <!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Liket')); ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome/4.7.0/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-style.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>" >
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="<?php echo e(asset('favicon/safari-pinned-tab.svg')); ?>" color="#ff0000">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>
<body>

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html>