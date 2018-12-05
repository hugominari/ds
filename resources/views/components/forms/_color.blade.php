<?php
$label = isset($icon) ? !empty($label) ? $label : $name : humanize(!empty($label) ? $label : $name);
$hide = (strpos(json_encode($attributes), 'hide') !== false) ? 'hide' : '';
?>

@pushonce('css:colorpicker')
{{ Html::style('plugins/colorpicker/bootstrap-colorpicker.css') }}
@endpushonce

@pushonce('js:colorpicker')
{{ Html::script('plugins/colorpicker/bootstrap-colorpicker.js') }}
@endpushonce

@pushonce('code:colorpicker')
$(function(){
$('.color').colorpicker();
});
@endpushonce

@if(isset($icon))
    <div class="input-group">
        <span class="input-group-addon"><i class="material-icons">{{$icon}}</i></span>
        <div class="form-group label-floating">
            <label class="control-label">{{$label}}</label>
            {{ Form::text($name, $value, array_merge(['class' => 'form-control color'], $attributes)) }}
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
        {{ Form::label($name, $label) }}
        @isset($help)
            <?php
            $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
            $help = str_replace(['success:', 'error:', 'info:'], '', $help);
            ?>
            <span class="help {{$class}}"> {{ $help }} </span>
        @endisset
        {{ Form::text($name, $value, array_merge(['class' => 'form-control color'], $attributes)) }}
    </div>
@endif