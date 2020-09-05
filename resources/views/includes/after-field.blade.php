<x-tall-attr :attr="$field->getAttr('after-field-wrapper')">
    @if($field->afterField)
        <x-tall-attr :attr="$field->getAttr('after-field')">
            {{ $field->afterField }}
        </x-tall-attr>
    @endif
    @if($field->help)
        <p class="{{ $this->getAttr('help') }}">
            {{ $field->help }}
        </p>
    @endif
    @error($temp_field_key)
        <p class="{{ $this->getAttr('error') }}">
            {{ $field->errorMsg ?? $this->errorMessage($message) }}
        </p>
    @enderror
</x-tall-attr>
