<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
$isCkeditor = array_filter($attributes, function($var){
	return preg_match("/\bckeditor\b/i", $var);
});
$classTxt = !empty($isCkeditor) ? '' : 'md-form';
?>

<?php if(! isset($__env->__pushonce_js_ckeditor)): $__env->__pushonce_js_ckeditor = 1; $__env->startPush('js'); ?>
<?php echo e(Html::script('//cdn.ckeditor.com/4.11.1/full/ckeditor.js')); ?>

<?php $__env->stopPush(); endif; ?>


<div class="form-group <?php echo e($classTxt); ?> <?php echo e($hide); ?>">
	<?php echo e(Form::label($name, $label, [], false)); ?>

	<?php echo e(Form::textarea($name, $value, array_merge(['class' => "md-textarea form-control"], $attributes))); ?>

	<?php if(isset($help)): ?>
		<?php
		$class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : ((strpos($help, 'muted:') !== false) ? 'text-muted' : 'text-danger'));
		$help = str_replace(['success:', 'error:', 'info:', 'muted:'], '', $help);
		?>
		<span class="help-block <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
	<?php endif; ?>
</div>
