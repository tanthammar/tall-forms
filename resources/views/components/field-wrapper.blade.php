@props([
    'colspan' => 6,
    'field' => "",
    'label' => "",
    'labelW' => config('tall-forms.label-width'),
    'fieldW' => config('tall-forms.field-width'),
    'align' => 'items-baseline',
    'inline' => true,
    'labelSuffix' => "",
])
<div class="{{ $inline ? 'sm:flex' : 'w-full'}} {{$align}}">
    <label for="{{ $field }}" class="w-full form-label {{ $inline ? $labelW : null }} {{ $inline ? 'sm:text-right' : 'text-left' }} pr-4">
        {{ $label }} <span class="italic text-black text-opacity-25 text-xs">{{ $labelSuffix }}</span>
    </label>
    <div class="w-full {{ $inline ? $fieldW : null }}">
        {{$slot}}
    </div>
</div>
