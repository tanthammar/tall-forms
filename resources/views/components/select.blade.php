@props([
'colspan' => 6,
'colclass' => config('tall-forms.col-span-classes'),
'field' => "",
'id' => false,
'label' => false,
'placeholder' => false,
'help' => false,
'errorMsg' => null,
'options' => [],
'fieldClass' => null,
])
<div {{ $attributes->merge(['class' => $colclass[$colspan]]) }}>
    @if($label)<label for="{{ $id ?? $field }}" class="form-label">{{ $label }}</label>@endif
    <select x-ref="{{ $field }}" wire:model.lazy="{{ $field }}" name="{{ $id ?? $field }}" class="form-select my-1 w-full {{$fieldClass}}">
        @if($placeholder)<option value="">{{ $placeholder }}</option>@endif
        @foreach($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    @if($help)<p class="help">{{ $help }}</p>@endif
    @error($field)<p class="error">{{ $errorMsg ?? $message }}</p>@enderror
</div>
