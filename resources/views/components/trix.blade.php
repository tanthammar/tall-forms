<div class="w-full"
     x-data="{
        trix: @entangle($field->key).defer,
        notFocused() { return document.activeElement !== this.$refs.trixInput },
        setValue() {
            {{-- replace content --}}
            this.$refs.trixInput.editor.loadHTML(this.trix);
            {{-- move cursor to the end--}}
            this.$refs.trixInput.editor.setSelectedRange(this.$refs.trixInput.editor.getDocument().toString().length - 1);
        },
    }"
     x-init="$watch('trix', () => notFocused() && setValue())"
     x-on:trix-change.debounce.300ms="trix = $refs.trixInput.value"
>
    <input value="{{ old($field->key) ?? $value }}" id="trix{{ md5($field->key) }}" name="trix{{ md5($field->key) }}" type="hidden" />
    <div wire:ignore x-on:trix-file-accept="return event.preventDefault()" class="no-upload">
        <trix-editor x-ref="trixInput" input="trix{{ md5($field->key) }}" {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }}></trix-editor>
    </div>
</div>
@if($field->includeScript)
@tfonce('styles:trix')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" media="print" onload="this.media='all'">
@endtfonce
@tfonce('scripts:trix')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endtfonce
@tfonce('styles:trix-no-upload')
<style>
    div.no-upload trix-toolbar span.trix-button-group.trix-button-group--file-tools {
        display: none;
    }
</style>
@endtfonce
@endif
