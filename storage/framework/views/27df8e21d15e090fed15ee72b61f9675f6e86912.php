<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

<div class="md-form form-group <?php echo e($hide); ?>">
    <?php echo e(Form::label($name, $label, [], false)); ?>

    <?php echo e(Form::tel($name, $value, array_merge(['class' => 'form-control tel'], $attributes))); ?>

    <?php if(isset($help)): ?>
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
    <?php endif; ?>
</div>