<?php

namespace Tanthammar\TallForms;

abstract class TallFormWithoutButtons extends TallFormComponent
{
    public function getFormProperty(): TallFormModel
    {
        $defaults = [
            'showSave' => false,
            'showDelete' => false,
            'showReset' => false,
            'showGoBack' => false,
            'wrapWithView' => false,
        ];

        return method_exists($this,'formAttr')
            ? TallFormModel::factory()->make(array_merge($defaults, $this->formAttr()))
            : TallFormModel::factory()->make($defaults);
    }
}
