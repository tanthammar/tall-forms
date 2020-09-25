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
    public $wrapWithView = true;
    public $wrapViewPath;

    public $onKeyDownEnter;

    public $labelW;
    public $fieldW;

    //this method is temporary moved to ConfigAttr::class
    /*public function compAttr($type)
        {
            return data_get(config('tall-forms.component-attributes'), $type, []);
        }*/
}
