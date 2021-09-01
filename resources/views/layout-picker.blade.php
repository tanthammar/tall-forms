<div class="display-contents">
    @if($this->form->wrapWithView)
        @include($this->form->wrapViewPath)
    @else
        @include('tall-forms::form')
    @endif
</div>
