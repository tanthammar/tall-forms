<?php


namespace Tanthammar\TallForms\Traits;


trait HasComponentDesign
{
    public $headView;
    public $afterFormView;
    public $beforeFormView;
    public $formTitle;
    public $formSubtitle;

    public $footerView;
    public $formFooterTitle;
    public $formFooterSubtitle;

    public $inline = true;
    public $inlineLabelAlignment; //set in mount
    public $wrapWithComponent = true;
    public $wrapComponentName;

    public $onKeyDownEnter;

    public $labelW;
    public $fieldW;

    public function getAttr($type)
    {
        return data_get(config('tall-forms.component-attributes'), $type, []);
    }
}
