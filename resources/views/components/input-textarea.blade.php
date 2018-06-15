@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $rows = isset($rows) ? $rows : 5;
    $name = isset($name) ? $name : $field;
    $id = isset($id) ? $id : $name;
@endphp

{{--  {{dd($inputValue)}}  --}}
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif
    <textarea rows="{{$rows}}" class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>{{ isset($inputValue) ? $inputValue : old($field) }}</textarea>  

    @if ($errors->has($field))
        <span class="help-block">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>