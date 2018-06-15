@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
@endphp
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  

    <input type="password" class="form-control" name="{{$name}}" id="{{$id}}" value="" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>

    @if ($errors->has($field))
        <span class="help-block">
            <strong>{{ __($errors->first($field)) }}</strong>
        </span>
    @endif
</div>