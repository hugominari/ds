<?php
$filename = is_object($value) ? $value->filename : '';
$mime = is_object($value) ? $value->mime : '';
$size = is_object($value) ? $value->size : '';
$maxSize = $value->maxSize ?? '';
$path = is_object($value) ? $value->path : '';
$url = is_object($value) ? $value->url : '';
$label = humanize($label);
$array = ((strpos($extraClass, 'dz-multiple') !== false) || $maxFile > 1) ? '[]' : '';
?>

<div class="form-group files">
    @if(empty($label))
        {{ Form::label($label, $label, ['style' => 'display:none']) }}
    @else
        {{ Form::label($label, $label) }}
    @endif
    <div class="dropzone {{ $extraClass }} {{ $name }} no-border" data-type='dropzone-crop'
         data-source="{{ route('default.uploadFile') }}" data-maxfiles="{{ $maxFile }}" data-message="{{ $message }}"
         data-accept="{{ $accept }}" data-maxsize="{{ $maxSize }}">
        <input type="hidden" id="{{ $name }}" name="{{ $name . $array }}" accept="{{ $accept }}" value="{{ $url }}"
               data-size="{{ $size }}" data-mime="{{ $mime }}" data-filename="{{ $filename }}" data-path="{{ $path }}">
    </div>
    @isset($help)
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block {{$class}}"> {{ $help }} </span>
    @endisset
</div>

@pushonce('css:dropzonecrop')
{{ Html::style('plugins/dropzone/dropzone.css') }}
{{ Html::style('plugins/cropper/3.1.6/cropper.min.css') }}
@endpushonce

@pushonce('js:dropzonecrop')
{{ Html::script('plugins/dropzone/dropzone.js') }}
{{ Html::script('plugins/cropper/3.1.6/cropper.min.js') }}
@endpushonce