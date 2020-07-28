@props([
    'field' => "",
    'label' => "",
    'id' => false,
    'value' => "",
])
<label class="inline-flex items-center">
    <input type="radio" class="form-radio" name="{{ $id ?? $field }}" wire:model="{{ $field }}" x-ref="{{ $field }}" value="{{$value}}">
    <span class="ml-2">{{$label}}</span>
</label>