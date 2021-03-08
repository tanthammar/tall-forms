<?php


namespace Tanthammar\TallForms;



class FileUpload extends BaseField
{

    public $multiple = false;
    public $livewireComponent;
    public $accept = "";
    public $maxBytes = null;
    public $sizeLimitAlert;

    //TODO Next major release, see confirmDelete() below
    /*
    public $confirm_delete = false;
    public $confirm_msg = '';
    */

    protected function overrides(): self
    {
        $this->type = 'file';
        $this->is_custom = true;
        return $this;
    }

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

    //TODO Decide default setting in next major release, see blade view resources/views/includes/file-loop.blade.php
    /*
     * Breaking change, until next release default behaviour is to confirm deletion.
     * This MIGHT change to align with default setting in Repeater.
    public function confirmDelete($message = ''): self
    {
        $this->confirm_delete = true;
        $this->confirm_msg = filled($message) ? $message : config('tall-forms.are-u-sure');
        return $this;
    }
    */
}

