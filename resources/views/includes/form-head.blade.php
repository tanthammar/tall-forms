@if(empty($headView) && !$wrapWithView && ($formTitle || $formSubtitle))
    <div class="tall-forms-form-head">
        <h1 class="tall-forms-form-title">
            {{ $formTitle }}
        </h1>
        <p class="tall-forms-form-sub-title">
            {{ $formSubtitle }}
        </p>
    </div>
@endif
@if(filled($headView))
    @include($headView)
@endif
