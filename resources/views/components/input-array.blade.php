<div x-data="inputArray({
        maxItems: {{ $field->maxItems }},
        minItems: {{ $field->minItems }},
        items: $wire.entangle('{{ $field->key }}'){{ $field->deferString }},
        fieldName: '{{ $field->name }}',
        fieldKey: '{{ $field->key }}',
        inputs: $refs.inputs
    })" class="{{ $field->wrapperClass }}">
    <div @error($field->key.'.*') class="{{ $field->errorClass }}" @enderror>
        <fieldset x-ref="inputs" id="{{ $field->id }}" name="{{ $field->name }}">
            <template x-for="(item, itemsIndex) in items" x-bind:key="itemsIndex">
                <div class="flex md:space-x-2 space-x-1">
                    <input
                        @if($field->disabled) disabled @endif
                        x-model="items[itemsIndex]"
                        x-bind:name="fieldName+itemsIndex"
                        x-bind:id="fieldKey+itemsIndex"
                        x-on:keydown.enter.prevent="addItem()"
                        x-on:keydown.backspace="if(items[itemsIndex].length == 0) deleteItem(itemsIndex)"
                        {{ $attributes->except([...array_keys($attr), 'x-model', 'disabled'])->whereDoesntStartWith('x-model')->merge($attr) }}
                    />
                    <button type="button" class="tf-repeater-delete-btn" x-on:click.prevent.prevent="deleteItem(itemsIndex)" tabindex="-1">
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
            items: config.items,
            fieldName: config.fieldName,
            fieldKey: config.fieldKey,
            inputs: config.inputs,
            addItem() {
                this.items = Array.from(this.items.filter(item => item.length > 0))
                if (this.maxItems === 0 || (this.maxItems > 0 && this.items.length < this.maxItems)) {
                    this.items.push('')
                } else {
                    this.shakeIt()
                }
                this.focusLastInput()
            },
            deleteItem(itemsIndex) {
                if (this.minItems === 0 || (this.minItems > 0 && this.items.length > this.minItems)) {
                    this.items.splice(itemsIndex, 1)
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
