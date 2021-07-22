<div x-data="inputArray({
    wireId: '{{ $_instance->id }}',
    fieldKey: '{{ $field->key }}',
    defer: {{json_encode($field->deferEntangle)}},
    maxItems: {{ $field->maxItems }},
    minItems: {{ $field->minItems }},
    inputs: $refs.inputs
})">
    <div @error($field->key.'.*') class="{{ $error() }}" @enderror>
        <div x-ref="inputs" wire:ignore>
            <template x-for="(item, index) in itemsArray" :key="index">
                <div class="flex md:space-x-2 space-x-1">
                    <input
                        x-model="itemsArray[index]"
                        x-on:keydown.enter.prevent="addItem()"
                        x-on:keydown.backspace="if(itemsArray[index].length == 0) deleteItem(index)"
                        @foreach($options() as $key => $value) {{$key}}="{{$value}}" @endforeach
                    />
                    <button type="button" class="tf-repeater-delete-btn" x-on:click.prevent.prevent="deleteItem(index)" tabindex="-1">
                        <x-tall-svg :path="config('tall-forms.trash-icon')" class="tf-repeater-btn-size" />
                    </button>
                </div>
            </template>
        </div>
        @error($field->key.'.*')
        <p class="tf-error">
            {{ $field->errorMsg ?? \Tanthammar\TallForms\ErrorMessage::parse($message) }}
        </p>
        @enderror
    </div>
    <button type="button" class="tf-repeater-add-button" x-on:click.prevent="addItem()" style="width:fit-content">
        <x-tall-svg :path="config('tall-forms.plus-icon')" class="tf-repeater-add-button-size" />
    </button>
</div>
{{-- input-array.js --}}
