@if($field->below || $field->help || $errors->has($field->key))
    <x-tall-attr :attr="$field->getAttr('below-wrapper')">
        @if($field->below)
            <x-tall-attr :attr="$field->getAttr('below')">
                {{ $field->below }}
            </x-tall-attr>
        @endif
        @if(!in_array($field->type, ['spatie-tags']))
            @if($field->help)
                <p class="tf-help">
                    {{ $field->help }}
                </p>
            @endif
        @endif
        @if(!in_array($field->type, ['file', 'spatie-tags']))
            @error($field->key)
            <p class="tf-error">
                {{ $field->errorMsg ?? \Tanthammar\TallForms\ErrorMessage::parse($message) }}
            </p>
            @enderror
        @endif
    </x-tall-attr>
@endif
