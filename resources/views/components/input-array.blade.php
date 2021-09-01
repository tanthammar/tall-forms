<div x-data="inputArray({
        maxItems: {{ $field->maxItems }},
        minItems: {{ $field->minItems }},
        itemsArray: $wire.entangle('{{ $field->key }}'){{ $field->deferString }},
        inputs: $refs.inputs
    })" class="{{ $field->wrapperClass }}">
    <div @error($field->key.'.*') class="{{ $field->errorClass }}" @enderror>
        <fieldset x-ref="inputs" wire:ignore id="{{ $field->id }}" name="{{ $field->name }}">
            <template x-for="(item, index) in itemsArray" :key="index">
                <div class="flex md:space-x-2 space-x-1">
                    <input
                        x-model="itemsArray[index]"
                        x-on:keydown.enter.prevent="addItem()"
                        x-on:keydown.backspace="if(itemsArray[index].length == 0) deleteItem(index)"
                        {{ $attributes->except([...array_keys($attr), 'x-model'])->whereDoesntStartWith('x-model')->merge($attr) }}
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
@tfonce('scripts:inputarray')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('inputArray', (config) => ({
            maxItems: config.maxItems,
            minItems: config.minItems,
            itemsArray: config.itemsArray,
            inputs: config.inputs,
            addItem() {
                this.itemsArray = Array.from(this.itemsArray.filter(item => item.length > 0))
                if (this.maxItems === 0 || (this.maxItems > 0 && this.itemsArray.length < this.maxItems)) {
                    this.itemsArray.push('')
                } else {
                    this.shakeIt()
                }
                this.focusLastInput()
            },
            deleteItem(index) {
                if (this.minItems === 0 || (this.minItems > 0 && this.itemsArray.length > this.minItems)) {
                    this.itemsArray.splice(index, 1)
                } else {
                    this.shakeIt()
                }
                this.focusLastInput()
            },
            focusLastInput() {
                this.$nextTick(() => this.inputs.lastElementChild?.firstElementChild?.focus())
            },
            shakeIt() {
                this.inputs.classList.add('shake')
                setTimeout(() => {
                    this.inputs.classList.remove('shake')
                }, 2000)
            }
        }))
    })
</script>
@endtfonce
