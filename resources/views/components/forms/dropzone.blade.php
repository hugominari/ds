<?php
$filename = $value->filename ?? '';
$mime = $value->mime ?? '';
$size = $value->size ?? '';
$maxSize = $value->maxSize ?? '';
$path = $value->path ?? '';
$url = $value->url ?? '';
$label = humanize($label);
$array = ((strpos($extraClass, 'dz-multiple') !== false) || $maxFile > 1) ? '[]' : '';
?>

<div class="form-group files">
    @if(empty($label))
        {{ Form::label($label, $label, ['style' => 'display:none']) }}
    @else
        {{ Form::label($label, $label) }}
    @endif
    <div class="dropzone {{ $extraClass }} {{ $name }} no-border" data-type='dropzone' data-source="{{ route('default.uploadFile') }}" data-maxfiles="{{ $maxFile }}" data-message="{{ $message }}" data-accept="{{ $accept }}" data-maxsize="{{ $maxSize }}">
        <input type="hidden" id="{{ $name }}" name="{{ $name . $array }}" accept="{{ $accept }}" value="{{ $url }}" data-size="{{ $size }}" data-mime="{{ $mime }}" data-filename="{{ $filename }}" data-path="{{ $path }}">
    </div>
    @isset($help)
        <?php
        $class = (strpos($help, 'success:') !== false) ? "text-success" : ((strpos($help, 'info:') !== false) ? 'text-info' : 'text-danger');
        $help = str_replace(['success:', 'error:', 'info:'], '', $help);
        ?>
        <span class="help-block {{$class}}"> {{ $help }} </span>
    @endisset
</div>

@pushonce('css:dropzone')
    {{ Html::style('plugins/dropzone/basic.min.css') }}
    {{ Html::style('plugins/dropzone/dropzone.min.css') }}
@endpushonce

@pushonce('js:dropzone')
    {{ Html::script('plugins/dropzone/dropzone.min.js') }}
@endpushonce