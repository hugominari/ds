<?php
$filename = $value->filename ?? '';
$mime = $value->mime ?? '';
$size = $value->size ?? '';
$maxSize = $value->maxSize ?? '';
$path = $value->path ?? '';
$url = $value->url ?? '';
$label = humanize($label);
$array = ((strpos($extraClass, 'dz-multiple') !== false) || $maxFile > 1) ? '[]' : '';
?>

<div class="form-group files">
    <?php if(empty($label)): ?>
        <?php echo e(Form::label($label, $label, ['style' => 'display:none'])); ?>

    <?php else: ?>
        <?php echo e(Form::label($label, $label)); ?>

    <?php endif; ?>
    <div class="dropzone <?php echo e($extraClass); ?> <?php echo e($name); ?> no-border" data-type='dropzone' data-source="<?php echo e(route('default.uploadFile')); ?>" data-maxfiles="<?php echo e($maxFile); ?>" data-message="<?php echo e($message); ?>" data-accept="<?php echo e($accept); ?>" data-maxsize="<?php echo e($maxSize); ?>">
        <input type="hidden" id="<?php echo e($name); ?>" name="<?php echo e($name . $array); ?>" accept="<?php echo e($accept); ?>" value="<?php echo e($url); ?>" data-size="<?php echo e($size); ?>" data-mime="<?php echo e($mime); ?>" data-filename="<?php echo e($filename); ?>" data-path="<?php echo e($path); ?>">
    </div>
    <?php if(isset($help)): ?>
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
    <?php endif; ?>
</div>

<?php if(! isset($__env->__pushonce_css_dropzone)): $__env->__pushonce_css_dropzone = 1; $__env->startPush('css'); ?>
    <?php echo e(Html::style('plugins/dropzone/basic.min.css')); ?>

    <?php echo e(Html::style('plugins/dropzone/dropzone.min.css')); ?>

<?php $__env->stopPush(); endif; ?>

<?php if(! isset($__env->__pushonce_js_dropzone)): $__env->__pushonce_js_dropzone = 1; $__env->startPush('js'); ?>
    <?php echo e(Html::script('plugins/dropzone/dropzone.min.js')); ?>

<?php $__env->stopPush(); endif; ?>