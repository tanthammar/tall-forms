export default (config) => ({
    maxItems: config.maxItems,
    minItems: config.minItems,
    itemsArray: config.defer
        ? window.Livewire.find(config.wireId).entangle(config.fieldKey).defer
        : window.Livewire.find(config.wireId).entangle(config.fieldKey),
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
})
