<div x-data="{ checkboxes: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }" class="w-full">
    <fieldset wire:ignore class="{{ $wrapperClass }}" id="{{ $id }}" name="{{ $name }}">
        @foreach($options as $value => $label)
            @php $id = 'id'.md5($id.$value.$label.$loop->index); @endphp
            <x-tall-checkbox
                :id="$id"
                :name="Str::slug(Str::lower($label))"
                :label="$label"
                :label-class="$labelClass"
                :class="$class"
                :attr="array_merge([
                    'wire:key' => $id,
                    'value' => $value,
                ], $attr)"
                x-model="checkboxes"
                {{ $attributes->except(['x-data', 'x-model']) }}
            />
        @endforeach
    </fieldset>
</div>
