<?php


namespace Tanthammar\TallForms;



class FileUpload extends BaseField
{

    public $type = 'file';
    public $is_custom = true;
    public $multiple = false;
    public $livewireComponent;


    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }
}

