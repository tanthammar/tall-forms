<div class="display-contents">
    @if($wrapWithView)
        @include($wrapViewPath)
    @else
        @include('tall-forms::form')
    @endif
</div>
