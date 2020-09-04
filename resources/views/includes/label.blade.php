<x-tall-attr tag="div" :attr="$field->getAttr('label-wrapper')">
    <x-tall-attr tag="label" :attr="$field->getAttr('label')">
        {{$field->label}}
    </x-tall-attr>
    @if(!$field->afterLabelView && $field->afterLabel)
    <x-tall-attr tag="div" :attr="$field->getAttr('after-label')">
        {{ $field->afterLabel }}
    </x-tall-attr>
    @endif
    @if(filled($field->afterLabelView))
        @include($field->afterLabelView)
    @endif
</x-tall-attr>
