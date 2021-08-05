<div {{ $attributes->only('x-data') }} @if($field->wrapperClass) class="{{ $field->wrapperClass }}" @endif>
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
                    {{ $attributes->except(['x-data', 'class', 'value', 'name', 'id', 'type'])->merge($attr) }}
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
