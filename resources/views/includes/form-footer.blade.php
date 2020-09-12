@if(empty($footerView) && ($formFooterTitle || $formFooterSubtitle))
    <div class="{{ $this->getAttr('form-footer') }}">
        <h3 class="{{ $this->getAttr('form-footer-title') }}">
            {{ $formFooterTitle }}
        </h3>
        <p tag="p" class="{{ $this->getAttr('form-footer-sub-title') }}">
            {{ $formFooterSubtitle }}
        </p>
    </div>
@endif
@if(filled($footerView))
    @include($footerView)
@endif
