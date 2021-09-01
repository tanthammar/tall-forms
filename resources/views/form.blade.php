@if($this->form->beforeFormView)
    @include($this->form->beforeFormView)
@endif
<x-tall-form :onKeyDownEnter="$this->form->onKeyDownEnter" :attr="config('tall-forms.component-attributes.form', [])">
    @include('tall-forms::includes.form-head')
    @if(isset($isTabs) && $isTabs)
        @include('tall-forms::fields.tabs')
    @else
        @include('tall-forms::includes.field-loop')
    @endif
    @include('tall-forms::includes.form-footer')
    @include('tall-forms::includes.buttons-root')
</x-tall-form>
@if($this->form->afterFormView)
    @include($this->form->afterFormView)
@endif
