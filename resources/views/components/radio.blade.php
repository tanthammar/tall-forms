<div x-data="{ radio: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }" class="{{ $field->wrapperClass }}">
    <fieldset id="{{ $field->id }}">
        @foreach($options as $value => $label)
            <div class="{{ $field->class }}">
                @php $id = "id" . md5($field->id.$value.$loop->index); @endphp
                <input
                    type="radio"
                    id="{{ $id }}"
                    name="{{ $field->name }}"
                    value="{{ $value }}"
                    wire:key="{{ $id }}"
                    class="{{ $field->radioClass }}"
                    x-model="radio"
                    {{ $attributes->except(['x-data', 'x-model', 'class', 'value', 'name', 'id', 'type'])->merge($attr) }}
                />
                <div class="{{ $field->spacing }}">
                    <label for="{{ $id }}" class="{{ $field->radioLabelClass }}">
                        {{ $label }}
                    </label>
                </div>
            </div>
        @endforeach
    </fieldset>
</div>
