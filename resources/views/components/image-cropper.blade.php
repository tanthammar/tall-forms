<div class="{{ $field->wrapperClass }}">
<div wire:ignore class="tf-cropper-root">
    {{-- init Alpine --}}
    <div x-data="imageCropper({
        imageUrl: '{{ $imageUrl }}',
        width: {{ $field->width }},
        height: {{ $field->height }},
        shape: '{{ $field->shape }}',
        fieldKey: '{{ $field->key }}'
    })" x-cloak>

        {{-- drop zone --}}
        <div x-show="!showCroppie && !hasImage">

            {{-- input --}}
            <input type="file" name="{{ $field->name }}"
                   id="{{ $field->id }}"
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
                <label for="{{ $field->id }}" class="tf-cropper-drop-zone">
                    {{ $field->dropZoneHelp }}
                </label>
                <p class="tf-cropper-file-info">
                    {{ $field->fileInfo }}
                </p>
                <button type="button" x-on:click.prevent class="tf-cropper-upload">
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
                        <button type="button" class="tf-cropper-delete" x-on:click.prevent="swap()">@lang('tf::form.delete')</button>
                        <button type="button" class="tf-cropper-save" x-on:click.prevent="saveCroppie()">@lang('tf::form.save')</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- result--}}
        <div x-show="!showCroppie && hasImage" class="relative {{ $field->thumbnail }}">
            <div class="tf-cropper-btns-root">
                <div class="tf-cropper-btns-wrapper">
                    <button type="button" class="tf-cropper-swap" x-on:click.prevent="remove()"><x-tall-svg :path="config('tall-forms.trash-icon')" class="h-6 w-6 fill-current" /></button>
                    <button type="button" class="tf-cropper-edit" x-on:click.prevent="edit()"><x-tall-svg :path="config('tall-forms.edit-icon')" class="h-6 w-6 fill-current" /></button>
                </div>
            </div>
            <div><img src="{{ $imageUrl }}" alt x-ref="result" class="display-block"></div>
        </div>

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
    {{--don't defer, get Croppie not defined errors --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"
            integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig=="
            crossorigin="anonymous"></script>
    @endtfonce
@endif

{{-- image-cropper.js --}}
