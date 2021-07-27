<div x-data="inputArray({
        maxItems: {{ $field->maxItems }},
        minItems: {{ $field->minItems }},
        itemsArray: {{ $field->itemsArray }},
        inputs: $refs.inputs
    })" class="{{ $field->wrapperClass }}">
    <div @error($field->key.'.*') class="{{ $field->errorClass }}" @enderror>
        <fieldset x-ref="inputs" wire:ignore id="{{ $field->id }}">
            <template x-for="(item, index) in itemsArray" :key="index">
                <div class="flex md:space-x-2 space-x-1">
                    <input
                        x-model="itemsArray[index]"
                        x-on:keydown.enter.prevent="addItem()"
                        x-on:keydown.backspace="if(itemsArray[index].length == 0) deleteItem(index)"
                        {{ $attributes->except('x-data')->merge($attr)->merge(['class' => $class()]) }}
                    />
                    <button type="button" class="tf-repeater-delete-btn" x-on:click.prevent.prevent="deleteItem(index)" tabindex="-1">
                        <x-tall-svg :path="config('tall-forms.trash-icon')" class="tf-repeater-btn-size fill-current" />
                    </button>
                </div>
            </template>
        </fieldset>
        @error($field->key.'.*')
        <p class="tf-error">
            {{ $field->errorMsg ?? \Tanthammar\TallForms\ErrorMessage::parse($message) }}
        </p>
        @enderror
    </div>
    <button type="button" class="tf-repeater-add-button" x-on:click.prevent="addItem()" style="width:fit-content">
        <x-tall-svg :path="config('tall-forms.plus-icon')" class="tf-repeater-add-button-size fill-current" />
    </button>
</div>
{{-- input-array.js --}}
