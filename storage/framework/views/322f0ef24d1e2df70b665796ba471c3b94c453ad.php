<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

<?php if(! isset($__env->__pushonce_css_datetimepicker)): $__env->__pushonce_css_datetimepicker = 1; $__env->startPush('css'); ?>
    <?php echo e(Html::style('plugins/datetimepicker/css/bootstrap-material-datetimepicker.css')); ?>

<?php $__env->stopPush(); endif; ?>

<?php if(! isset($__env->__pushonce_js_datetimepicker)): $__env->__pushonce_js_datetimepicker = 1; $__env->startPush('js'); ?>
    <?php echo e(Html::script('plugins/datetimepicker/js/bootstrap-material-datetimepicker.js')); ?>

<?php $__env->stopPush(); endif; ?>

<?php if(! isset($__env->__pushonce_code_datepicker)): $__env->__pushonce_code_datepicker = 1; $__env->startPush('code'); ?>
$(function(){
    $('.date').bootstrapMaterialDatePicker({
        lang : 'pt-BR',
        weekStart : 0,
        time: false,
        format: 'DD/MM/YYYY'
    });
});
<?php $__env->stopPush(); endif; ?>

<div class="md-form <?php echo e($hide); ?>">
    <?php echo e(Form::label($name . $required, $label)); ?>

    <?php echo e(Form::text($name, $value, array_merge(['class' => 'form-control date'], $attributes))); ?>

    <?php if(isset($help)): ?>
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
    <?php endif; ?>
</div>
