{{-- @dd(is_null($field->key)) --}}
<div 
    x-data = "{ 
        quill: @entangle($field->key).defer, 
        notFocused() { return document.activeElement !== document.getElementById('quill{{ md5($field->name) }}') },
        setValue() { 
            if(this.quill === null)
                quill{{ $field->name }}.root.innerHTML = '';
        }
    }"
    wire:model.lazy="{{ $field->key }}"
    x-init="
    quill{{ $field->name }} = initQuill{{md5($field->name)}}();
    quill{{ $field->name }}.on('selection-change', range => {
        if (!range) {
            @this.set(`{{ $field->key }}`, quill{{ $field->name }}.root.innerHTML)
        }
    });
    $watch('quill', () => notFocused() && setValue());
    "
    >
    <div wire:ignore class="quill{{ md5($field->name) }}">
        <div id="quill{{ md5($field->name) }}" input="quill{{ md5($field->name) }}" {{ $attributes->merge(['class' => $errors->has($field->key) ? $error() : $class() ]) }} x-cloak>{!! old($field->key) ?? $value !!}</div>
    </div>
</div>
@push('styles')
    <!-- quill stylesheets -->
    @if($field->theme === 'bubble')
        <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    @else
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @endif
    @if($field->allowFullScreen)
    <style>
        .ql-fullscreen:after {
                font-weight: bold;
                content: "FS";
            }
            .ql-formats .ql-fullscreen{
                margin-top: -5px;
            }
            #quill{{md5($field->name)}},:fullscreen {
                background-color: rgba(255,255,255,1);
            }
            #quill{{md5($field->name)}}:-webkit-full-screen {
                background-color: rgba(255,255,255,1);
            }
            #quill{{md5($field->name)}}:-moz-full-screen {
                background-color: rgba(255,255,255,1);
            }
    </style>
    @endif
@endpush
@push('scripts')
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
@if($field->allowFullScreen)
<script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/5.1.0/screenfull.min.js" integrity="sha512-SGPHIoS+NsP1NUL5RohNpDs44JlF36tXLN6H3Cw+EUyenEc5zPXWqfw9D+xmvR00QYUYewQIJQ6P5yH82Vw6Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endif
<script>
    function initQuill{{md5($field->name)}}() {
    // quill states & config vars
    var isMediaAllowed{{md5($field->name)}} = "{{ $field->allowMedia }}";
    var isFullScreen{{md5($field->name)}} = "{{ $field->allowFullScreen }}";
    var isQuillAdvanced{{md5($field->name)}} = "{{ $field->quillAdvanced }}";
    var toolbarOptions{{md5($field->name)}} = [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote', 'code-block'],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    [{ 'header': 1 }, { 'header': 2 }]
        ];

        if( isQuillAdvanced{{md5($field->name)}} ){
            toolbarOptions{{md5($field->name)}}.push(             // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],
            )
        }
        if( isMediaAllowed{{md5($field->name)}} ){
            toolbarOptions{{md5($field->name)}}.push([ 'link', 'image', 'video', 'formula' ])
        }
        var options{{md5($field->name)}} = {
        debug: 'false',
        placeholder: "{{ $field->default }}",
        theme: "{{ $field->theme }}"
    };
    //add clear button on last position
    toolbarOptions{{md5($field->name)}}.push([ 'clean' ])

    //if allowFullScreen add the FS button to toolbar at the end
    if(isFullScreen{{md5($field->name)}}){
            toolbarOptions{{md5($field->name)}}.push(['fullscreen']);
        }

    options{{md5($field->name)}}['modules'] = {
        toolbar: toolbarOptions{{md5($field->name)}}
    }
        return new Quill("#quill{{md5($field->name)}}", options{{md5($field->name)}});
    }

    window.onload=function(){
        document.fullscreenEnabled =
            document.fullscreenEnabled ||
            document.mozFullScreenEnabled ||
            document.documentElement.webkitRequestFullScreen;
    function requestFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullScreen) {
                element.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        }
    var customFSButton = document.querySelector('.ql-fullscreen');
    var toggleButton = false;
        customFSButton.addEventListener('click', function() {
            if (document.fullscreenEnabled && !toggleButton) {
            toggleButton = true;
            // screenfull.request();
            requestFullscreen(document.querySelector(".quill{{ md5($field->name) }}"));
            } else {
                console.log('Screenfull not enabled');
                screenfull.exit();
                toggleButton = false;
            }
        });
    }
</script>
@endpush
