<div class="w-full" x-data="{ ckeditor: @entangle($field->key).defer }"
     x-init="
            {{ $field->editorType }}.create($refs.{{ md5($field->name) }}, {{ $field->getEditorConfig() }})
            .then( function(editor){
                editor.model.document.on('change:data', () => {
                    $dispatch('input', editor.getData())
                 });
            });
        "
     wire:ignore
     x-model.debounce.500ms="ckeditor"
>
    <input name="{{ $field->name }}" value="{{ old($field->key) ?? $value }}" type="hidden" id="{{ md5($field->name) }}" />
    <div wire:ignore>
        <textarea @if($field->required) required @endif x-model.debounce.500ms="ckeditor" x-ref="{{ md5($field->name) }}" input="{{ md5($field->name) }}" {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }} x-cloak>{{ old($field->key) ?? $value }}</textarea>
    </div>
</div>
@if($field->includeScript)
    @tfonce('scripts:ckeditor')
        <script src="{{ $field->editorScript }}" type="text/javascript"></script>
    @endtfonce
@endif
