{{-- before field --}}
@if($field->above)
    <x-tall-attr tag="p" :attr="$field->getAttr('above')">{{ $field->above }}</x-tall-attr>
@endif
{{-- field --}}
@if($field->dynamicComponent)
    <x-dynamic-component :component="'tall-'.$field->type" :field="$field" />
@else
    @include('tall-forms::fields.' . $field->type)
@endif
{{-- after field --}}
@if($field->below || $field->help || $errors->has($field->key))
    @include('tall-forms::includes.below')
@endif
