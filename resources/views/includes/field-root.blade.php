<x-tall-attr :attr="$field->getAttr('root')" :colspan="$field->colspan ?? 12">
    @if($field->view)
        {{-- custom view --}}
        @include($field->view)
    @elseif($field->livewireComponent)
        {{-- custom Livewire component --}}
        @livewire($field->livewireComponent, $field->livewireParams)
    @elseif($field->input_type === 'hidden')
        <input x-ref="{{ $field->key }}" {{ $field->wire }}="{{ $field->key }}" name="{{ $field->key }}" type="hidden"
        autocomplete="{{ $field->autocomplete }}" class="nosy" />
    @else
        {{-- before --}}
        @include('tall-forms::includes.before')
        {{-- label and field wrapper --}}
        @php
            $temp_inline = $field->inline === true ?? $inline;
            $field->inline = $field->inline === false ? false : $temp_inline;
        @endphp
        <x-tall-attr
            :attr="$field->inline ? $field->getAttr('label-field-wrapper-inline') : $field->getAttr('label-field-wrapper-stacked')">
            {{-- label --}}
            @include('tall-forms::includes.label')
            {{-- field column --}}
            <div class="w-full {{ $field->inline ? $field->fieldW : null }}">
                {{-- field --}}
                @if($field->type === 'array')
                    @include('tall-forms::includes.array-wrapper')
                @elseif($field->type === 'keyval')
                    @include('tall-forms::includes.keyval-wrapper')
                @else
                    @include('tall-forms::includes.input-wrapper')
                @endif
            </div>
        </x-tall-attr>
        {{-- after --}}
        @include('tall-forms::includes.after')
    @endif
</x-tall-attr>
