@php
    $error = filled($errors->get("$field->key.*"));
@endphp
<div x-data="{
    open: false,
    field: $wire.entangle('{{ $field->key }}'){{ $field->deferString }}
    }" @if($field->wrapperClass) class="{{ $field->wrapperClass }}" @endif>
    <div x-cloak
         x-show="!field.length"
         type="text"
         class="form-select my-1"
         x-on:click="open = !open">
        {{ $field->placeholder }}
    </div>
    {{-- TODO investigate why the merge error class, below doesn't apply the class, then remove the wrapping div --}}
    <div @if($error) class="{{ $field->errorClass }} border px-1" @endif>
    <select x-cloak
            x-show="open || field.length"
            x-model="field"
            x-on:click.outside.stop="open = false"
            multiple
            @if($field->disabled) disabled @endif
            {{ $attributes->except([...array_keys($attr), 'disabled', 'multiple'])->whereDoesntStartWith('x-model')->merge($attr)->merge(['class' => $error ? $field->errorClass : $field->class ]) }}>
        @forelse($field->options as $value => $label)
            <option class="p-2" wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option class="p-2" value="" disabled>...</option>
        @endforelse
    </select>
    </div>
    <div>
        @if($error)
            <p class="tf-error">@lang('tf::form.multiselect.error-msg')</p>
        @endif
    </div>
</div>
