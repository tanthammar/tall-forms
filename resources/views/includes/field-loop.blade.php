{{-- used by views.includes.tabs and views.form --}}
<x-tall-attr :attr="config('tall-forms.component-attributes.fields-wrapper', [])">
    @foreach($fields as $field)
        @if(filled($field))
            @php $field->setHtmlId($_instance->id); @endphp
            @include('tall-forms::includes.field-root')
        @endif
    @endforeach
</x-tall-attr>
