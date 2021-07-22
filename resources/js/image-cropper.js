export default (config) => ({
    showCroppie: false,
    hasImage: config.imageUrl.length > 0,
    originalSrc: config.imageUrl,
    width: config.width,
    height: config.height,
    shape: config.shape,
    fieldKey: config.fieldKey,
    croppie: {},
    init() { this.$nextTick(() => this.initCroppie())},
    updatePreview() {
        let reader, files = this.$refs.input.files
        reader = new FileReader()
        reader.onload = (e) => {
            this.showCroppie = true
            this.originalSrc = e.target.result
            this.bindCroppie(e.target.result)
        }
        reader.readAsDataURL(files[0])
    },
    initCroppie() {
        this.croppie = new Croppie(this.$refs.croppie, {
            viewport: {width: this.width, height: this.height, type: this.shape}, //circle or square
            boundary: {width: this.width, height: this.height}, //default boundary container
            showZoomer: true,
            enableResize: false
        })
    },
    swap() {
        this.$refs.input.value = null
        this.showCroppie = false
        this.hasImage = false
        this.$refs.result.src = ""
    },
    remove() {
        this.$refs.input.value = null
        this.showCroppie = false
        this.hasImage = false
        this.$refs.result.src = ""
        this.$wire.set(this.fieldKey, '')
    },
    edit() {
        this.$refs.input.value = null
        this.showCroppie = true
        this.hasImage = false
        this.$refs.result.src = ""
        this.bindCroppie(this.originalSrc)
    },
    saveCroppie() {
        this.croppie.result({
            type: "base64",
            size: "original"
        }).then((croppedImage) => {
            this.$refs.result.src = croppedImage
            this.showCroppie = false
            this.hasImage = true
            this.$wire.set(this.fieldKey, croppedImage)
        })
    },
    bindCroppie(src) { //avoid problems with croppie container not being visible when binding
        setTimeout(() => {
            this.croppie.bind({url: src})
        }, 200)
    }
})
