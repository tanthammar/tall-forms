@if(empty($headView) && !$wrapWithComponent && ($formTitle || $formSubtitle))
    <div class="{{ $this->getAttr('form-head') }}">
        <h1 class="{{ $this->getAttr('form-title') }}">
            {{ $formTitle }}
        </h1>
        <p class="{{ $this->getAttr('form-sub-title') }}">
            {{ $formSubtitle }}
        </p>
    </div>
@endif
@if(filled($headView))
    @include($headView)
@endif
