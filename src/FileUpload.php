<?php


namespace Tanthammar\TallForms;



class FileUpload extends BaseField
{

    public $type = 'file';
    public $is_custom = true;
    public $multiple = false;
    public $livewireComponent;
    public $accept = "";
    public $maxBytes = null;
    public $sizeLimitAlert;


    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    /**
     * Example: "image/*,.pdf" <br><br>
     * A string that defines the file types you accept. <br>
     * A comma-separated list of unique file type specifiers. <br>
     * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file#Unique_file_type_specifiers
     * @param string $typeSpecifier
     * @return FileUpload
     */
    public function accept(string $typeSpecifier): self
    {
        $this->accept = $typeSpecifier;
        return $this;
    }


    public function image(): self
    {
        $this->accept = "image/*";
        return $this;
    }

}

