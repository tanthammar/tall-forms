@if(empty($field->beforeView) && filled($field->before))
    <x-tall-attr :attr="$field->getAttr('before')">
        <x-tall-attr tag="p" :attr="$field->getAttr('before-text')">
            {{ $field->before }}
        </x-tall-attr>
    </x-tall-attr>
@endif
@if(filled($field->beforeView))
    @include($field->beforeView)
@endif
