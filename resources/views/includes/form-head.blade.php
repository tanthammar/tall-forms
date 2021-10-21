@if(blank($this->form->headView) && !$this->form->wrapWithView && ($this->form->formTitle || $this->form->formSubtitle))
    <div class="tf-form-head">
        <h1 class="tf-form-title">
            {{ $this->form->formTitle }}
        </h1>
        <p class="tf-form-sub-title">
            {{ $this->form->formSubtitle }}
        </p>
    </div>
@endif
@if(filled($this->form->headView))
    @include($this->form->headView)
@endif
