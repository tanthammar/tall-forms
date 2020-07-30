@props([
    'colspan' => 6,
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
])
<div {{ $attributes->merge(['class' => "sm:col-span-{$colspan}"]) }}>
    @if($label)
    <label for="{{ $id ?? $field }}" class="block text-sm font-medium leading-5 text-gray-500">
        {{ $label ?? ''}} {{ old($field) }}
    </label>
    @endif
<div class="my-1 flex rounded-md shadow-sm w-full relative {{$fieldClass}}">
    @if($icon)
        <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            @svg($icon, 'h-4 w-4')
        </span>
    @endif
        @if($prefix)
        <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $prefix }}
        </span>
        @endif
    <input x-ref="{{ $field }}" wire:model.lazy="{{ $field }}" value="{{ old($field) }}" name="{{ $id ?? $field }}" type="{{ $type }}" @if($autocomplete)autocomplete="{{ $autocomplete }}"@endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif class="flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
            {{ ($prefix) ? ' rounded-none rounded-r-md ' : ' rounded ' }}
            @error($field) error placeholder-red-300 @enderror" />
        @error($field)
        <x-tall-error-icon :right="($type == 'date' || $type == 'datetime-local' || $type == 'time') ? 'right-6' : 'right-0'" @endif />
        @enderror
    </div>
    @if($help)<p class="help">{{ $help }}</p>@endif
    @error($field)<p class="error">{{ $errorMsg ?? $message }}</p>@enderror
</div>
