<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

@pushonce('css:datetimepicker')
    {{ Html::style('plugins/datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endpushonce

@pushonce('js:datetimepicker')
    {{ Html::script('plugins/datetimepicker/js/bootstrap-material-datetimepicker.js') }}
@endpushonce

@pushonce('code:datepicker')
$(function(){
    $('.date').bootstrapMaterialDatePicker({
        lang : 'pt-BR',
        weekStart : 0,
        time: false,
        format: 'DD/MM/YYYY'
    });
});
@endpushonce

<div class="md-form {{ $hide }}">
    {{ Form::label($name . $required, $label) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control date'], $attributes)) }}
    @isset($help)
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block {{$class}}"> {{ $help }} </span>
    @endisset
</div>
