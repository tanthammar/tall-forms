<div x-data="{ checkboxes: $wire.entangle('{{ $field->key }}'){{ $field->deferString }} }" class="w-full">
    <fieldset wire:ignore class="{{ $field->wrapperClass }}" id="{{ $field->id }}" name="{{ $field->name }}">
        @foreach($field->options as $value => $label)
            @php
                $id = 'id'.md5($field->id.$value.$label.$loop->index);
            @endphp
            <div class="flex">
                <input
                    type="checkbox"
                    x-model="checkboxes"
                    id="{{ $id }}"
                    wire:key="{{ $id }}"
                    value="{{ $value }}"
                    name="{{ $field->key }}"
                    class="{{ $field->class }}"
                    @if($field->disabled) disabled @endif
                />
                <div class="{{ $field->labelWrapperClass }}">
                    <label for="{{ $id }}" class="{{ $field->checkboxLabelClass }}">
                        {{ $label }}
                    </label>
                </div>
            </div>
        @endforeach
    </fieldset>
</div>
