@if(empty($headView) && !$wrapWithView && ($formTitle || $formSubtitle))
    <div class="tf-form-head">
        <h1 class="tf-form-title">
            {{ $formTitle }}
        </h1>
        <p class="tf-form-sub-title">
            {{ $formSubtitle }}
        </p>
    </div>
@endif
@if(filled($headView))
    @include($headView)
@endif
