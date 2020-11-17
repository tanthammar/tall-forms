<div wire:ignore class="tf-cropper-root">
    {{-- init Alpine --}}
    <div x-data="imageData{{ md5($field->name) }}()" x-init="initCroppie()" x-cloak>

        {{-- drop zone --}}
        <div x-show="!showCroppie && !hasImage">

            {{-- input --}}
            <input type="file" name="fileinput{{$field->name}}"
                   class="absolute inset-0 z-50 m-0 p-0 w-full h-full outline-none opacity-0 cursor-pointer"
                   x-ref="input"
                   x-on:change="updatePreview()"
                   x-on:dragover="$el.classList.add('active')"
                   x-on:dragleave="$el.classList.remove('active')"
                   x-on:drop="$el.classList.remove('active')">

            {{-- upload icon --}}
            <div class="flex flex-col items-center justify-center">
                <svg class="tf-cropper-icon " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <label for="fileinput{{$field->name}}" class="tf-cropper-drop-zone">
                    {{ $field->dropZoneHelp }}
                </label>
                <p class="tf-cropper-file-info">
                    {{ $field->fileInfo }}
                </p>
                <button type="button" x-on:click="javascript:void(0)" class="tf-cropper-upload">
                    {{ $field->uploadButton }}
                </button>
            </div>

        </div>

        {{-- cropper --}}
        <div x-show="showCroppie" x-on:click.prevent class="tf-cropper-modal-bg">
            <div class="tf-cropper-modal">
                <div>
                    <div class="m-auto" x-ref="croppie"></div>
                    <div class="flex justify-center items-center gap-2">
                        <button type="button" class="tf-cropper-delete" x-on:click.prevent="swap()">@lang(config('tall-forms.delete'))</button>
                        <button type="button" class="tf-cropper-save" x-on:click.prevent="saveCroppie()">@lang(config('tall-forms.save'))</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- result--}}
        <div x-show="!showCroppie && hasImage" class="relative {{ $field->thumbnail }}">
            <div class="tf-cropper-btns-root">
                <div class="tf-cropper-btns-wrapper">
                    <button type="button" class="tf-cropper-swap" x-on:click.prevent="swap()"><x-tall-svg :path="config('tall-forms.trash-icon')" class="h-6 w-6" /></button>
                    <button type="button" class="tf-cropper-edit" x-on:click.prevent="edit()"><x-tall-svg :path="config('tall-forms.edit-icon')" class="h-6 w-6" /></button>
                </div>
            </div>
            <div><img src="{{ $imageUrl }}" alt x-ref="result" class="display-block"></div>
        </div>

    </div>
</div>
@if($field->includeScript)
@tfonce('styles:imagecropper')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css"
      integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg=="
      crossorigin="anonymous" media="print" onload="this.media='all'"/>
@endtfonce
@tfonce('scripts:imagecropper')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
        integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
        crossorigin="anonymous" defer></script>
@endtfonce
@endif
@push('scripts')
    <script>
        function imageData{{ md5($field->name) }}() {
            return {
                showCroppie: false,
                hasImage: @json(filled($imageUrl)),
                originalSrc: "{{ $imageUrl }}",
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
                },
                edit() {
                    this.$refs.input.value = null;
                    this.showCroppie = true;
                    this.hasImage = false;
                    this.$refs.result.src = "";
                    this.bindCroppie(this.originalSrc);
                },
                saveCroppie() {
                    this.croppie.result({
                        type: "base64",
                        size: "original"
                    }).then((croppedImage) => {
                        this.$refs.result.src = croppedImage;
                        this.showCroppie = false;
                        this.hasImage = true;
                        @this.set('{{ $field->key }}', croppedImage);
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
