@if(empty($footerView) && ($formFooterTitle || $formFooterSubtitle))
    <div class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-footer') }}">
        <h3 class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-footer-title') }}">
            {{ $formFooterTitle }}
        </h3>
        <p tag="p" class="{{ \Tanthammar\TallForms\ConfigAttr::key('form-footer-sub-title') }}">
            {{ $formFooterSubtitle }}
        </p>
    </div>
@endif
@if(filled($footerView))
    @include($footerView)
@endif
