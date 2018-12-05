<?php
$required = str_contains($name, '*') ? '<i class="fa fa-asterisk m-l-5 text-red font-13 tip cursor-help" title="Obrigatório" aria-hidden="true"></i>' : '';
$name = str_replace('*', '', $name);
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name) . $required;
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

@pushonce('css:datetimepicker')
{{ Html::style('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}
@endpushonce

@pushonce('js:datetimepicker')
{{ Html::script('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}
@endpushonce

@pushonce('code:timepicker')
$(function(){
$('.time').bootstrapMaterialDatePicker({
date: false,
shortTime: false,
format: 'HH:mm',
switchOnClick: false
});
});
@endpushonce


@if(isset($icon))
    <div class="input-group">
        <span class="input-group-addon"><i class="material-icons">{{$icon}}</i></span>
        <div class="form-group label-floating">
            <label class="control-label">{{$label}}</label>
            {{ Form::text($name, '', array_merge(['class' => 'form-control time'], $attributes)) }}
        </div>
        @if($help != '')
            <br>
            <?php
            $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
            $help = str_replace(['success:', 'error:', 'info:'], '', $help);
            ?>
            <span class="help-block {{$class}}"> {{ $help }} </span>
        @endif
    </div>
@else
    <div class="form-group {{ $hide }}">
        {{ Form::label($name . $required, $label) }}
        {{ Form::text($name, '', array_merge(['class' => 'form-control time'], $attributes)) }}
        @isset($help)
            <?php
            $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
            $help = str_replace(['success:', 'error:', 'info:'], '', $help);
            ?>
            <span class="help-block {{$class}}"> {{ $help }} </span>
        @endisset
    </div>
@endif