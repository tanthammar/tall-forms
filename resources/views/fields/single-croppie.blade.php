<x-tall-field-wrapper :inline="$field->inline ?? $inline" :field="$field->name" :label="$field->label"
                      :labelSuffix="$field->labelSuffix"
                      :labelW="$field->labelW" :fieldW="$field->fieldW">
<div class="w-full max-w-2xl p-8 mx-auto bg-white rounded-lg relative hover:shadow-outline-gray">
    {{ data_get($this, $field->key) }}
    {{-- init Alpine --}}
    <div x-data="imageData()" x-init="initCroppie()" class="active:shadow-sm active:border-blue-500">

        {{-- drop zone --}}
        <div x-show="!showCroppie && !hasImage">

            {{-- input --}}
            <input type="file" name="fileinput" class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                   x-ref="input"
                   x-on:change="updatePreview()"
                   x-on:dragover="$el.classList.add('active')"
                   x-on:dragleave="$el.classList.remove('active')"
                   x-on:drop="$el.classList.remove('active')">

            {{-- upload icon --}}
            <div class=" flex flex-col space-y-2 items-center justify-center">
                @svg('light/cloud-upload-alt', 'h-12 w-12')
                <label for="fileinput" class="cursor-pointer text-center uppercase text-bold py-2">
                    Drag an image here or click in this area.
                </label>
                <button type="button" x-on:click="javascript:void(0)" class="flex items-center mx-auto py-2 px-4 text-white text-center font-medium border border-transparent rounded-md outline-none bg-teal-700">
                    Select a file
                </button>
            </div>

        </div>

        {{-- cropper --}}
        <div x-show="showCroppie">
            <div class="mx-auto"><img src alt x-ref="croppie" class="display-block w-full"></div>
            <div class="py-2 flex justify-between items-center">
                <button type="button" class="bg-red-500 text-white p-2 rounded" x-on:click="swap()">Delete</button>
                <button type="button" class="bg-teal-500 text-white p-2 rounded" x-on:click="saveCroppie()">Save</button>
            </div>
        </div>

        {{-- result--}}
        <div x-show="!showCroppie && hasImage" class="relative w-full h-full bg-blue-300">
            <div class="z-10 absolute m-auto top-0 right-0 p-8">
                <button type="button" class="bg-red-500 text-white p-2 rounded" x-on:click="swap()">Swap</button>
                <button type="button" class="bg-teal-500 text-white p-2 rounded" x-on:click="edit()">Edit</button>
            </div>
            <div><img src="{{ old($field->key) }}" alt x-ref="result" class="display-block"></div>
        </div>

    </div>
</div>
</x-tall-field-wrapper>
@if($field->includeScript)
    @pushonce('head:cropper')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" media="print" onload="this.media='all'" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous" defer></script>
    @endpushonce
@endif
@pushonce('scripts:single-cropper')
<script>
    function imageData() {
        return {
            showCroppie: false,
            hasImage: {{ filled($field->key) }},
            originalSrc: "{{ old($field->key) }}",
            croppie: {},

            updatePreview() {
                var reader,
                    files = this.$refs.input.files;

                reader = new FileReader();

                reader.onload = (e) => {
                    this.showCroppie = true;
                    this.originalSrc = e.target.result;
                    this.bindCroppie(e.target.result);
                };

                reader.readAsDataURL(files[0]);
            },
            initCroppie() {
                this.croppie = new Croppie(this.$refs.croppie, {
                    viewport: { width: 420, height: 340, type: "square" }, //circle
                    boundary: { width: 420, height: 340 }, //default boundary container
                    showZoomer: true,
                    enableResize: false
                });
            },
            swap() {
                this.$refs.input.value = null;
                this.showCroppie = false;
                this.hasImage = false;
                this.$refs.result.src = "";
                //update som kind of array
            },
            edit() {
                this.$refs.input.value = null;
                this.showCroppie = true;
                this.hasImage = false;
                this.$refs.result.src = "";
                this.bindCroppie(this.originalSrc); //this.$refs.result.src //or some array value
                //update som kind of array
            },
            saveCroppie() {
                this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        this.$refs.result.src = croppedImage;
                        this.showCroppie = false;
                        this.hasImage = true;
                        @this.set('{{$field->key}}', croppedImage);
                    });
            },
            bindCroppie(src) { //avoid problems with croppie container not being visible when binding
                setTimeout(() => {
                    this.croppie.bind({ url: src });
                }, 200);
            }
        };
    }
</script>
@endpushonce
