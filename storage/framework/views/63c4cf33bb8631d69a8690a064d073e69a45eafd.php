<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

<div class="form-group <?php echo e($hide); ?>">
	<?php echo e(Form::select($name, $list, $selected, array_merge(['class' => 'js-select mdb-select md-form', 'id' => $name], $attributes), $optAtributtes, $optGroupsAttributes)); ?>

	<?php echo e(Form::label($name, $label, [], false)); ?>

	
	<?php if(isset($help)): ?>
		<?php
		$class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : ((strpos($help, 'muted:') !== false) ? 'text-muted' : 'text-danger'));
		$help = str_replace(['success:', 'error:', 'info:', 'muted:'], '', $help);
		?>
		<span class="help <?php echo e($class); ?>"> <?php echo e($help); ?> </span>
	<?php endif; ?>
</div>