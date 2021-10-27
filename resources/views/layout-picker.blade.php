<div class="display-contents">
    @if($form->wrapWithView)
        @include($form->wrapViewPath)
    @else
        @include('tall-forms::form')
    @endif
</div>
