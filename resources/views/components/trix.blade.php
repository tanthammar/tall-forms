<div class="w-full" x-data="{ trix: @entangle($temp_key).defer }">
    <input value="{{ $value }}" id="{{ $field->name }}" name="{{ $field->name }}" class="form-input" />
    <div wire:ignore x-on:trix-change.debounce.500ms="trix = $refs.trixInput.value">
        <trix-editor x-ref="trixInput" input="{{ $field->name }}"></trix-editor>
    </div>
    <button wire:click.prevent="click">Submit</button>
</div>
@once
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" media="print" onload="this.media='all'">
@endpush
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endpush
@endonce
