<x-tall-attr :attr="$field->getAttr('root')" :colspan="$field->colspan ?? 12">
    @if($field->view)
        {{-- custom view --}}
        @include($field->view)
    @elseif($field->livewireComponent)
        {{-- custom Livewire component --}}
        @livewire($field->livewireComponent, $field->livewireParams)
    @else
        {{-- before --}}
        @include('tall-forms::includes.before')
        {{-- label and field wrapper --}}
        <x-tall-attr :attr="$field->getAttr('label-field-wrapper')">
            {{-- label --}}
            @include('tall-forms::includes.label')
            {{-- field column --}}
            <x-tall-attr :attr="$field->getAttr('field-col')">
                {{-- field --}}
                @if($field->type === 'array')
                    @include('tall-forms::includes.array-wrapper')
                @elseif($field->type === 'keyval')
                    @include('tall-forms::includes.keyval-wrapper')
                @else
                    @include('tall-forms::includes.input-wrapper')
                @endif
            </x-tall-attr>
        </x-tall-attr>
        {{-- after --}}
        @include('tall-forms::includes.after')
    @endif
</x-tall-attr>
