<div class="w-full" x-data="{ trix: @entangle($temp_key).defer, latestAttachment: {} }">
    <input value="{{ old($temp_key) ?? $value }}" id="{{ $field->name }}" name="{{ $field->name }}" type="hidden" />
    <div wire:ignore
         x-on:trix-change.debounce.500ms="trix = $refs.trixInput.value"
         x-on:attachment-saved-{{ $field->name }}.window="latestAttachment.setAttributes({ url: $event.detail.path });"
         x-on:trix-file-accept="
             if(event.file && (event.file.size/1024) > {{ $field->maxKB }}) {
                alert('{{ $field->sizeLimitAlert }}');
                return event.preventDefault();
             }"
         x-on:trix-attachment-add="
             if(event.attachment.file) {
                let attachment = event.attachment;
                @this.upload('{{ $field->attachmentKey }}', attachment.file, (uploadedFile) => {
                    //success
                    latestAttachment = attachment;
                }, () => {
                    //error
                    alert('The server encountered an error when trying to save your file upload. Please try again or contact support');
                }, (event) => {
                    //trix progress-bar
                    attachment.setUploadProgress(event.detail.progress);
                })
             }"
         x-on:trix-attachment-remove="$wire.deleteTrixUpload(event.attachment.attachment.previewURL, event.attachment.attachment.attributes.values.url.split('/').pop())">
        <trix-editor x-ref="trixInput" input="{{ $field->name }}" {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}></trix-editor>
    </div>
    @error($field->attachmentKey)<p class="text-red-600">{{ $message }}</p>@enderror
</div>
@once
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" media="print" onload="this.media='all'">
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endpush
@endonce
