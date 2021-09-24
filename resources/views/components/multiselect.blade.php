<div x-data="{
    open: false,
    field: $wire.entangle('{{ $field->key }}'){{ $field->deferString }}
    }" @if($field->wrapperClass) class="{{ $field->wrapperClass }}" @endif>
    <div x-cloak
         x-show="!field.length"
         type="text"
         class="form-select my-1 cursor-pointer"
         x-on:click="open = !open">
        {{ $field->placeholder }}
    </div>
    {{-- TODO investigate why the merge error class, below doesn't apply the class, then remove the wrapping div --}}
    <div @class([
            'border px-1 form-select',
            $field->errorClass => $errors->has($field->key),
            $field->class => !$errors->has($field->key)
    ])>
    <select x-cloak
            x-show="open || field.length"
            x-model="field"
            x-on:click.outside.stop="open = false"
            multiple
            @if($field->disabled) disabled @endif
            class="@error($field->key) tf-field-error @else form-select @enderror"
            {{ $attributes->except([...array_keys($attr), 'disabled', 'multiple', 'class'])->whereDoesntStartWith('x-model')->merge($attr) }}>
        @forelse($field->options as $value => $label)
            <option class="p-2" wire:key="id{{ md5($field->id.$field->key.$value) }}" value="{{ $value }}">{{ $label }}</option>
        @empty
            <option class="p-2" value="" disabled>...</option>
        @endforelse
    </select>
    </div>
    <div>
        @if ($errors->any())
            @foreach ($errors->keys() as $message)
                <div>{{ $message }}</div>
            @endforeach
        @endif
    </div>
</div>
