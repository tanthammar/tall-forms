@if(empty($field->afterView) && filled($field->after))
    <x-tall-attr :attr="$field->getAttr('after')">
        <x-tall-attr tag="p" :attr="$field->getAttr('after-text')">
            {{ $field->after }}
        </x-tall-attr>
    </x-tall-attr>
@endif
@if(filled($field->afterView))
    @include($field->afterView)
@endif
