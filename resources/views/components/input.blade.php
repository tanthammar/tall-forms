@props([
    'colspan' => 6,
    'colclass' => config('tall-forms.col-span-classes'),
    'field' => "",
    'label' => null,
    'id' => null,
    'type' => 'text',
    'prefix' => null,
    'icon' => null,
    'autocomplete' => null,
    'placeholder' => null,
    'help' => null,
    'errorMsg' => null,
    'fieldClass' => null,
    'wrapperClass' => null,
    'step' => null,
    'min' => null,
    'max' => null,
    'labelSuffix' => "",
])
<div class="{{$wrapperClass}} {{$fieldClass}}">
        @if($prefix || $icon)
        <span
            class="inline-flex items-center px-1 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            @if($icon)
                <span class="mx-1">@svg($icon, 'h-4 w-4')</span>
            @endif
            @if($prefix)
                <span class="mx-1">{{ $prefix }}</span>
            @endif
        </span>
        @endif
    <input x-ref="{{ $field }}" wire:model.lazy="{{ $field }}" value="{{ old($field) }}" name="{{ $id ?? $field }}" type="{{ $type }}" @if($autocomplete)autocomplete="{{ $autocomplete }}"@endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif class="flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
            {{ ($prefix || $icon) ? ' rounded-none rounded-r-md ' : ' rounded ' }} @error($field) error placeholder-red-300 @enderror"
           @if(in_array($type, ['number', 'range', 'date', 'datetime-local', 'month', 'time', 'week'])) min="{{ $min }}" max="{{ $max }}" step="{{ $step }}" @endif/>
        @error($field)
        <x-tall-error-icon :right="($type == 'date' || $type == 'datetime-local' || $type == 'time') ? 'right-6' : 'right-0'" />
        @enderror
</div>
