<div wire:ignore class="w-full p-4 mx-auto border-gray-300 border-2 border-gray-300 border-dashed rounded-lg relative hover:shadow-outline-gray">
        {{-- init Alpine --}}
        <div x-data="imageData{{$field->name}}()" x-init="initCroppie()" class="active:shadow-sm active:border-blue-500" x-cloak>

            {{-- drop zone --}}
            <div x-show="!showCroppie && !hasImage">

                {{-- input --}}
                <input type="file" name="fileinput"
                       class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0"
                       x-ref="input"
                       x-on:change="updatePreview()"
                       x-on:dragover="$el.classList.add('active')"
                       x-on:dragleave="$el.classList.remove('active')"
                       x-on:drop="$el.classList.remove('active')">

                {{-- upload icon --}}
                <div class=" flex flex-col items-center justify-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <label for="fileinput" class="cursor-pointer text-center uppercase text-sm text-bold text-gray-600">
                        {{ $field->dropZoneHelp }}
                    </label>
                    <p class="text-xs text-gray-500">
                        {{ $field->fileInfo }}
                    </p>
                    <button type="button" x-on:click="javascript:void(0)"
                            class="flex items-center mx-auto mt-2 px-2 text-white text-sm text-center font-medium border border-transparent rounded outline-none bg-gray-500">
                        {{ $field->uploadButton }}
                    </button>
                </div>

            </div>

            {{-- cropper --}}
            <div x-show="showCroppie" class="fixed top-0 left-0 p-8 h-screen w-screen z-50 bg-white">
                <div class="mx-auto my-auto"><img src alt x-ref="croppie" class="display-block w-full"></div>
                <div class="flex justify-center items-center gap-2">
                    <button type="button" class="bg-red-500 text-white p-2 rounded" x-on:click="swap()">Delete</button>
                    <button type="button" class="bg-teal-500 text-white p-2 rounded" x-on:click="saveCroppie()">Save</button>
                </div>
            </div>

            {{-- result--}}
            <div x-show="!showCroppie && hasImage" class="relative {{ $field->thumbnailClass }}">
                <div class="z-10 absolute top-0 right-0 bottom-0 left-0">
                    <div class="flex gap-2 h-full w-full items-center justify-center">
                        <button type="button" class="bg-red-500 text-white p-2 rounded" x-on:click="swap()">Swap</button>
                        <button type="button" class="bg-teal-500 text-white p-2 rounded" x-on:click="edit()">Edit</button>
                    </div>
                </div>
                <div><img src="{{ old($field->key) }}" alt x-ref="result" class="display-block"></div>
            </div>

        </div>
    </div>
@if($field->includeScript)
@once
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"
      integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg=="
      crossorigin="anonymous" media="print" onload="this.media='all'"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
        integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
        crossorigin="anonymous" defer></script>
@endpush
@endonce
@endif
@push('scripts')
<script>
    function imageData{{$field->name}}() {
        return {
            showCroppie: false,
            hasImage: @json(filled(data_get($this, $field->key))),
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
                    viewport: {width: {{ $field->width }}, height: {{ $field->height }}, type: "{{ $field->shape }}"}, //circle or square
                    boundary: {width: {{ $field->width }}, height: {{ $field->height }}}, //default boundary container
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
                    this.croppie.bind({url: src});
                }, 200);
            }
        };
    }
</script>
@endpush
