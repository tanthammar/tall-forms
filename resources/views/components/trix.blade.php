<div class="w-full" x-data>
    <input wire:model.defer="{{ $temp_key }}" x-ref="wiretrix" value="{{ $value }}" id="{{ $field->name }}" name="{{ $field->name }}" class="form-input" />
    <div wire:ignore x-on:trix-change.debounce.300ms="$refs.wiretrix.value = $refs.trix.value">
        <trix-editor x-ref="trix" input="{{ $field->name }}"></trix-editor>
    </div>
</div>
@once
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" media="print" onload="this.media='all'">
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endpush
@endonce
