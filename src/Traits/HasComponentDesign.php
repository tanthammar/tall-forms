<?php


namespace Tanthammar\TallForms\Traits;


trait HasComponentDesign
{
    public $headView;
    public $onceView;
    public $formTitle;
    public $formSubtitle;

    public $footerView;
    public $formFooterTitle;
    public $formFooterSubtitle;

    public $inline = true;
    public $wrapWithComponent = true;
    public $wrapComponentName;

    public function getAttr($type)
    {
        return data_get(config('tall-forms.component-attributes'), $type, []);
    }
}
