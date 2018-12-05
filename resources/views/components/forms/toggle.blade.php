<?php
$checked = (!empty($checked) && ($checked ||  $checked == '1')) ? 'checked="checked"' : '';
$label = humanize(!empty($label) ? $label : $value);
$type = $type == 'list' ? 'toggle-list' : 'toggle-side';
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

<div class="form-group {{ $type }} {{ $hide }}">
	<label class="bs-switch">
		<input type="checkbox" id="{{ $name . '_' . $value }}" name="{{ $name }}" value="{{ $value }}" {{ $checked }}>
		<span class="slider round"></span> {{ $label }}
	</label>
</div>

