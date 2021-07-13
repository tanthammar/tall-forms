{{-- used by views.includes.tabs and views.form --}}
<x-tall-attr :attr="config('tall-forms.component-attributes.fields-wrapper', [])">
    @foreach($fields as $field)
        @if(filled($field))
            @include('tall-forms::includes.field-root')
        @endif
    @endforeach
</x-tall-attr>
