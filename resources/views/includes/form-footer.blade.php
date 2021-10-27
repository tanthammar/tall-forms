@if(blank($form->footerView) && ($form->formFooterTitle || $form->formFooterSubtitle))
    <div class="tf-form-footer">
        <h3 class="tf-form-footer-title">
            {{ $form->formFooterTitle }}
        </h3>
        <p tag="p" class="tf-form-footer-sub-title">
            {{ $form->formFooterSubtitle }}
        </p>
    </div>
@endif
@if(filled($form->footerView))
    @include($form->footerView)
@endif
