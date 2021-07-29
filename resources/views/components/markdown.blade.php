<div
    x-data="{
        easyMde: {},
        value: {{ $field->value }},
        get focused() { return this.easyMde?.codemirror?.hasFocus() },
        setValue() {
            this.easyMde.value(this.value)
        }
    }"
     x-init="$nextTick(() => {
        easyMde = new EasyMDE({
            element: $refs.input{{ $jsonOptions() }}
         })
         easyMde.codemirror.on('{{ $field->syncOn }}', function(){
            value = easyMde.value()
        })
        $watch('value', () => !focused && setValue())
     })"
class="{{ $field->wrapperClass }}">
    <div wire:ignore x-cloak>
    <textarea
        x-ref="input"
        name="{{ $field->id }}"
        id="{{ $field->id }}"
        {{ $attributes->merge($attr)->merge(['class' => 'hidden']) }}
    >{{ old($field->key, $slot) }}</textarea>
    </div>
</div>
@if($field->includeScript)
    @tfonce('styles:markdown')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/easymde/dist/easymde.min.css" media="print" onload="this.media='all'">
    @endtfonce
    @tfonce('scripts:markdown')
    <script type="text/javascript" src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    @endtfonce
@endif
