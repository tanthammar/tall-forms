@props([
'colspan' => 6,
'colclass' => config('tall-forms.col-span-classes'),
'field' => "",
'label' => "",
'id' => null,
'type' => 'range',
'help' => null,
'errorMsg' => null,
'fieldClass' => null,
'step' => null,
'min' => null,
'max' => null,
])
<div {{ $attributes->merge(['class' => $colclass[$colspan]]) }}>

        <label for="{{ $id ?? $field }}">
            <span class="block text-sm font-medium leading-5 text-gray-500">{{ $label ?? ''}}</span>
            <div class="flex space-x-2 py-2 {{$fieldClass}}">
                <div class="rounded border px-2 font-bold">{{ data_get($this, $field) ?? $min }}</div>
                <div>{{$min}}</div>
                <input x-ref="{{ $field }}" wire:model="{{ $field }}"
                       value="{{ old($field) }}"
                       name="{{ $id ?? $field }}"
                       type="range"
                       min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"
                       class="form-range mt-1 block w-full" />
                <div>{{$max}}</div>
            </div>

        </label>
    @if($help)<p class="help">{{ $help }}</p>@endif
    @error($field)<p class="error">{{ $errorMsg ?? $message }}</p>@enderror
</div>
