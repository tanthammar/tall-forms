<?php

namespace Tanthammar\TallForms;

abstract class TallFormWithoutButtons extends TallFormComponent
{
    public function getFormProperty(): object
    {
        $defaults = [
            'showSave' => false,
            'showDelete' => false,
            'showReset' => false,
            'showGoBack' => false,
            'wrapWithView' => false,
        ];

        $defaults = array_merge(config('tall-forms.form'), $defaults);

        return method_exists($this,'formAttr')
            ? (object) array_merge($defaults, $this->formAttr())
            : (object) $defaults;
    }
}
