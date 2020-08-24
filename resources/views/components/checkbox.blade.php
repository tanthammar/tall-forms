@props([
'field' => "",
'label' => "",
'id' => null,
'help' => false,
'errorMsg' => null,
'value' => false,
'html' => null,
])
<div {{ $attributes->merge(['class' => "flex"]) }}>
<input x-ref="{{ $field }}" wire:model="{{ $field }}" name="{{ $id ?? $field }}" type="checkbox" @if($value)value="{{$value}}"@endif
        class="form-checkbox mt-1 h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
    <div class="ml-2 block">
        <label for="{{ $id ?? $field }}" class="text-sm leading-5 text-gray-900">
            {{ $label ?? ''}}
        </label>
        @error($field)<p class="error" style="line-height: 0.5rem">{{ $errorMsg ?? $this->errorMessage($message) }}</p>
        @else
        @if($help)<p class="help">{{ $help }}</p>@endif
        @if($html)<p class="help">{!! $html !!}</p>@endif
        @enderror
    </div>
</div>
