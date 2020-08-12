@props([
    'colspan' => 6,
    'field' => "",
    'label' => "",
    'labelW' => config('tall-forms.label-width'),
    'fieldW' => config('tall-forms.field-width'),
    'align' => 'items-baseline',
    'inline' => true,
])
<div class="{{ $inline ? 'sm:flex' : 'w-full'}} {{$align}}">
    <label for="{{ $field }}" class="w-full form-label {{ $inline ? $labelW : null }} {{ $inline ? 'sm:text-right' : 'text-left' }} pr-4">
        {{ $label }}
    </label>
    <div class="w-full {{ $inline ? $fieldW : null }}">
        {{$slot}}
    </div>
</div>
