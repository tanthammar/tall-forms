@if(empty($headView) && !$wrapWithComponent && ($formTitle || $formSubtitle))
    <div class="{{ $this->compAttr('form-head') }}">
        <h1 class="{{ $this->compAttr('form-title') }}">
            {{ $formTitle }}
        </h1>
        <p class="{{ $this->compAttr('form-sub-title') }}">
            {{ $formSubtitle }}
        </p>
    </div>
@endif
@if(filled($headView))
    @include($headView)
@endif
