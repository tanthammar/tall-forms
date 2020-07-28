@props([
    'colspan' => 6,
    'field' => "",
    'label' => "",
    'labelW' => 'sm:w-1/3',
    'fieldW' => 'sm:w-2/3',
    'align' => 'items-center'
])
<div class="col-span-{{ $colspan }} {{ $this->inline ? 'sm:flex' : 'w-full'}} {{$align}}">
    <label for="{{ $field }}" class="w-full form-label {{ $this->inline ? $labelW : null }} {{ $this->inline ? 'sm:text-right' : 'text-left' }} pr-4">
        {{ $label }}
    </label>
    <div class="w-full {{ $this->inline ? $fieldW : null }}">
        {{$slot}}
    </div>
</div>
