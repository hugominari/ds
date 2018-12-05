<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

<div class="md-form form-group {{ $hide }}">
	{{ Form::label($name, $label, [], false) }}
	{{ Form::textarea($name, $value, array_merge(['class' => "md-textarea form-control"], $attributes)) }}
	<a class="btn-floating btn-lg blue-gradient js-submit-form js-submit-icon-only">
		<i class="fa fa-send"></i>
	</a>
	@isset($help)
		<?php
		$class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : ((strpos($help, 'muted:') !== false) ? 'text-muted' : 'text-danger'));
		$help = str_replace(['success:', 'error:', 'info:', 'muted:'], '', $help);
		?>
		<span class="help-block {{$class}}"> {{ $help }} </span>
	@endisset
	
</div>