<x-tall-field-root
    :in-array="$field->inArray"
    :colspan="$field->colspan ?? 12"
    :attr="$field->getAttr('root')">
    @if($field->view)
        {{-- custom view --}}
        @include($field->view)
    @elseif($field->livewireComponent)
        {{-- custom Livewire component --}}
        @livewire($field->livewireComponent, $field->livewireParams)
    @elseif($field->type === 'hidden')
        <input x-ref="{{ $field->key }}" {{ $field->wire }}="{{ $field->key }}" name="{{ $field->key }}" type="hidden"
        autocomplete="{{ $field->autocomplete }}" class="nosy" />
    @else
        {{-- before --}}
        @include('tall-forms::includes.before')
        {{-- label and field --}}
        <x-tall-label-field-wrapper
            :field="$field"
            :componentInline="$inline"
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
        @include('tall-forms::includes.after')
    @endif
</x-tall-field-root>
