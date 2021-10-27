@if(blank($form->headView) && !$form->wrapWithView && ($form->formTitle || $form->formSubtitle))
    <div class="tf-form-head">
        <h1 class="tf-form-title">
            {{ $form->formTitle }}
        </h1>
        <p class="tf-form-sub-title">
            {{ $form->formSubtitle }}
        </p>
    </div>
@endif
@if(filled($form->headView))
    @include($form->headView)
@endif
