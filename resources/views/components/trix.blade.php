<div class="w-full" x-data="{ trix: @entangle($field->key).defer }">
    <input value="{{ old($field->key) ?? $value }}" id="{{ md5($field->name) }}" name="{{ $field->name }}" type="hidden" />
    <div wire:ignore x-on:trix-file-accept="return event.preventDefault()">
        <trix-editor x-model.debounce.500ms="trix" input="{{ md5($field->name) }}" {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}></trix-editor>
    </div>
</div>
@if($field->includeScript)
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
@endif
