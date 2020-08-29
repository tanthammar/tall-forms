<div class="display-contents">
    @if($wrapWithComponent)
        @include($wrapComponentName)
    @else
        @include('tall-forms::form')
    @endif
</div>
