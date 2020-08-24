@props([
    'colspan' => 6,
    'colclass' => config('tall-forms.col-span-classes'),
    'rows' => 3,
    'id' => null,
    'field' => null,
    'placeholder' => null,
    'help' => null,
    'errorMsg' => null,
    'label' => null,
    'fieldClass' => null,
    'labelSuffix' => "",
])
<div {{ $attributes->merge(['class' => $colclass[$colspan]]) }}>
    @if($label)<label for="{{ $id ?? $field }}" class="form-label">{{ $label }} <span class="italic text-black text-opacity-25 text-xs">{{ $labelSuffix }}</span></label>@endif
    <div class="my-1 w-full">
        <textarea x-ref="{{ $field }}" wire:model.lazy="{{ $field }}" name="{{ $id ?? $field }}" rows="{{ $rows }}"
            class="form-textarea block w-full {{$fieldClass}} @error($field) error placeholder-red-300 @enderror"
            @if($placeholder)placeholder="{{ $placeholder }}" @endif></textarea>
    </div>
    @if($help)<p class="help">{{ $help }}</p>@endif
    @error($field)<p class="error">{{ $errorMsg ?? $this->errorMessage($message) }}</p>@enderror
</div>
