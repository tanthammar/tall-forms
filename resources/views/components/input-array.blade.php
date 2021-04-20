<div x-data="{
        inputArray: @entangle($field->key){{$field->defer}},
        maxItems: {{ $field->maxItems ?? 0 }},
        minItems: {{ $field->minItems ?? 0 }},
        addItem() {
            this.inputArray = Array.from(this.inputArray.filter(item => item.length > 0))
            if (this.maxItems == 0 || (this.maxItems > 0 && this.inputArray.length < this.maxItems)) {
                this.inputArray.push('')
            } else {
                this.shakeIt()
            }
            this.focusLastInput()
        },
        deleteItem(index) {
            if (this.minItems == 0 || (this.minItems > 0 && this.inputArray.length > this.minItems)) {
                this.inputArray.splice(index, 1)
            } else {
                this.shakeIt()
            }
            this.focusLastInput()
        },
        focusLastInput() {
            this.$nextTick(() => {
                this.$refs.inputs.lastElementChild.firstElementChild.focus()
            })
        },
        shakeIt() {
            this.$refs.inputs.classList.add('shake')
            setTimeout(() => {
                this.$refs.inputs.classList.remove('shake')
            }, 2000)
        }
    }">
    <div @error($field->key.'.*') class="{{ $error() }}" @enderror>
        <div x-ref="inputs" wire:ignore>
            <template x-for="(item, index) in inputArray" :key="index">
                <div class="flex md:space-x-2 space-x-1">
                    <input
                        x-model="inputArray[index]"
                        x-on:keydown.enter.prevent="addItem()"
                        x-on:keydown.backspace="if(inputArray[index].length == 0) deleteItem(index)"
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
