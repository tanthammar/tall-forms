@if(empty($headView) && !$wrapWithComponent && ($formTitle || $formSubtitle))
    <div class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-head') }}">
        <h1 class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-title') }}">
            {{ $formTitle }}
        </h1>
        <p class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-sub-title') }}">
            {{ $formSubtitle }}
        </p>
    </div>
@endif
@if(filled($headView))
    @include($headView)
@endif
