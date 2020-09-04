<x-tall-attr tag="div" :attr="$this->getAttr('root')">
    @include('tall-forms::includes.form-head')
    <x-tall-attr tag="div" :attr="$this->getAttr('form')">
    @foreach($fields as $field)
        @if(filled($field))
            @include('tall-forms::includes.field-root')
        @endif
    @endforeach
    </x-tall-attr>
    @include('tall-forms::includes.form-footer')
    @include('tall-forms::includes.buttons-root')
</x-tall-attr>
@if($onceView)
    @include($onceView)
@endif
