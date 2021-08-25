<x-tall-field-root
    :in-array="$field->inArray"
    :colspan="$field->colspan ?? 12"
    :attr="$field->getAttr('root')">
    @if($field->view)
        {{-- custom view --}}
        @include($field->view, $field->data ?? [])
    @elseif($field->livewireComponent)
        {{-- custom Livewire component --}}
        @livewire($field->livewireComponent, $field->livewireParams)
    @elseif($field->type === 'hidden')
        <input x-ref="{{ $field->key }}" {{ $field->wire }}="{{ $field->key }}" name="{{ $field->key }}" type="hidden"
        autocomplete="{{ $field->autocomplete }}" class="nosy" />
    @else
        {{-- before --}}
        @if(filled($field->beforeView) || filled($field->before))
            @include('tall-forms::includes.before')
        @endif
        {{-- label and field --}}
        <x-tall-label-field-wrapper
            :field="$field"
            :inline="$inline"
            :inlineLabelAlignment="$inlineLabelAlignment"
            :label-w="$labelW"
            :field-w="$fieldW">
            @if($field->type === 'array')
                @include('tall-forms::includes.array-wrapper')
            @elseif($field->type === 'keyval')
                @include('tall-forms::includes.keyval-wrapper')
            @else
                @include('tall-forms::includes.field-wrapper')
            @endif
        </x-tall-label-field-wrapper>
        {{-- after --}}
        @if(filled($field->afterView) || filled($field->after))
            @include('tall-forms::includes.after')
        @endif
    @endif
</x-tall-field-root>
