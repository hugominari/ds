<?php
$checked = (!empty($checked) && $checked) ? 'checked' : null;
$label = !empty($label) ? $label : null;
$type = $type == 'list' ? '' : 'form-check-inline';
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
?>

<div class="form-check <?php echo e($type); ?> <?php echo e($hide); ?>">
    <input type="checkbox" class="form-check-input" id="<?php echo e($name . '_' . $value); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" <?php echo e($checked); ?>>
    <label class="form-check-label" for="<?php echo e($name . '_' . $value); ?>"><?php echo $label; ?></label>
    <?php if(isset($help)): ?>
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
    <?php endif; ?>
</div>