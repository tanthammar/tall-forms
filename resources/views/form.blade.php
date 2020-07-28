<div class="display-contents">
    @if($spaMode)
        @include($spaLayout)
    @else
        @include('tall-forms::form-layout')
    @endif
</div>
