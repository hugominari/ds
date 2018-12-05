<?php
$checked = (!empty($checked) && $checked) ? 'checked' : null;
$label = !empty($label) ? $label : null;
$type = $type == 'list' ? '' : 'form-check-inline';
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
?>

<div class="form-check {{ $type }} {{ $hide }}">
    <input type="checkbox" class="form-check-input" id="{{ $name . '_' . $value }}" name="{{ $name }}" value="{{ $value }}" {{ $checked }}>
    <label class="form-check-label" for="{{ $name . '_' . $value }}">{!! $label !!}</label>
    @isset($help)
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block {{ $class }}"> {{ $help }} </span>
    @endisset
</div>