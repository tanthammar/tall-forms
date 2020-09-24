@if($beforeFormView)
    @include($beforeFormView)
@endif
<x-tall-form :onKeyDownEnter="$onKeyDownEnter" :attr="[]">
    @include('tall-forms::includes.form-head')
    <x-tall-attr :attr="\Tanthammar\TallForms\ConfigAttr::key('fields-wrapper')">
    @foreach($fields as $field)
        @if(filled($field))
            @include('tall-forms::includes.field-root')
        @endif
    @endforeach
    </x-tall-attr>
    @include('tall-forms::includes.form-footer')
    @include('tall-forms::includes.buttons-root')
</x-tall-form>
@if($afterFormView)
    @include($afterFormView)
@endif
