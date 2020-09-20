@if(empty($footerView) && ($formFooterTitle || $formFooterSubtitle))
    <div class="{{ $this->compAttr('form-footer') }}">
        <h3 class="{{ $this->compAttr('form-footer-title') }}">
            {{ $formFooterTitle }}
        </h3>
        <p tag="p" class="{{ $this->compAttr('form-footer-sub-title') }}">
            {{ $formFooterSubtitle }}
        </p>
    </div>
@endif
@if(filled($footerView))
    @include($footerView)
@endif
