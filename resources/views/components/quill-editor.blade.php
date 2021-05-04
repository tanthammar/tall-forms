
<div 
    x-data = "{ quill: @entangle($field->key).defer }"
    wire:ignore
    wire:model.lazy="{{ $field->key }}"
    x-init="
    quill{{ $field->name }} = initQuill();
    quill{{ $field->name }}.on('text-change', function () {
    @this.set(`{{ $field->key }}`, quill{{ $field->name }}.root.innerHTML)
    });
    "
>
<div wire:ignore>
        <div id="quill{{ md5($field->name) }}" {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }} x-cloak>{!! old($field->key) ?? $value !!}</div>
    </div>
</div>
@push('styles')
    <!-- quill stylesheets -->
    @if($field->theme === 'bubble')
        <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    @else
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endif
@endpush
@push('scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
// quill states & config vars
var isMediaAllowed{{md5($field->name)}} = "{{ $field->allowMedia }}";
var isQuillAdvanced{{md5($field->name)}} = "{{ $field->quillAdvanced }}";
var toolbarOptions{{md5($field->name)}} = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],
                ['clean']                                         // remove formatting button
    ];

    if( isMediaAllowed{{md5($field->name)}} ){
        toolbarOptions{{md5($field->name)}}.push([ 'link', 'image', 'video', 'formula' ])
    }
    var options{{md5($field->name)}} = {
    debug: 'false',
    placeholder: "{{ $field->default }}",
    theme: "{{ $field->theme }}"
};
if( isQuillAdvanced{{md5($field->name)}} ){
    options{{md5($field->name)}}['modules'] = {
        toolbar: toolbarOptions{{md5($field->name)}}
    }
}
function initQuill() {
    return new Quill("#quill{{md5($field->name)}}", options{{md5($field->name)}});
}
</script>
@endpush
