@if(blank($this->form->footerView) && ($this->form->formFooterTitle || $this->form->formFooterSubtitle))
    <div class="tf-form-footer">
        <h3 class="tf-form-footer-title">
            {{ $this->form->formFooterTitle }}
        </h3>
        <p tag="p" class="tf-form-footer-sub-title">
            {{ $this->form->formFooterSubtitle }}
        </p>
    </div>
@endif
@if(filled($this->form->footerView))
    @include($this->form->footerView)
@endif
