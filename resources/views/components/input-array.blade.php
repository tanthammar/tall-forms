<div x-data="itemsArray({
    wireId: '{{ $_instance->id }}',
    fieldKey: '{{ $field->key }}',
    defer: '{{$field->deferEntangle}}',
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
@tfonce('scripts:itemsArrayCmp')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('itemsArray', (config) => ({
        maxItems: config.maxItems,
        minItems: config.minItems,
        itemsArray: config.defer === '.defer' ? window.Livewire.find(config.wireId).entangle(config.fieldKey).defer : window.Livewire.find(config.wireId).entangle(config.fieldKey),
        inputs: config.inputs,
        addItem() {
            this.itemsArray = Array.from(this.itemsArray.filter(item => item.length > 0))
            if (this.maxItems == 0 || (this.maxItems > 0 && this.itemsArray.length < this.maxItems)) {
                this.itemsArray.push('')
            } else {
                this.shakeIt()
            }
            this.focusLastInput()
        },
        deleteItem(index) {
            if (this.minItems == 0 || (this.minItems > 0 && this.itemsArray.length > this.minItems)) {
                this.itemsArray.splice(index, 1)
            } else {
                this.shakeIt()
            }
            this.focusLastInput()
        },
        focusLastInput() { this.$nextTick(() => this.inputs.lastElementChild?.firstElementChild?.focus()) },
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
