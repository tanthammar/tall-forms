<div class="w-full" x-data="{ trix: @entangle($temp_key).defer }">
    <input value="{{ old($temp_key) ?? $value }}" id="{{ $field->name }}" name="{{ $field->name }}" type="hidden" />
    <div wire:ignore
         x-on:trix-change.debounce.500ms="trix = $refs.trixInput.value"
         x-on:trix-file-accept="return event.preventDefault()">
        <trix-editor x-ref="trixInput" input="{{ $field->name }}" {{ $attributes->merge(['class' => $errors->has($temp_key) ? $error() : $class() ]) }}></trix-editor>
    </div>
</div>
@once
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" media="print" onload="this.media='all'">
    <style>
        span.trix-button-group.trix-button-group--file-tools {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endpush
@endonce
