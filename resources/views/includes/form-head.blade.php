@if(empty($headView) && !$wrapWithComponent && ($formTitle || $formSubtitle))
    <x-tall-attr :attr="$this->getAttr('form-head')">
        <x-tall-attr tag="h1" :attr="$this->getAttr('form-title')">
            {{ $formTitle }}
        </x-tall-attr>
        <x-tall-attr tag="p" :attr="$this->getAttr('form-sub-title')">
            {{ $formSubtitle }}
        </x-tall-attr>
    </x-tall-attr>
@endif
@if(filled($headView))
    @include($headView)
@endif
