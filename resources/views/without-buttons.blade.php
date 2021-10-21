@if(isset($isTabs) && $isTabs)
    @include('tall-forms::fields.tabs')
@else
    @include('tall-forms::includes.field-loop')
@endif
