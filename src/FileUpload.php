<?php


namespace Tanthammar\TallForms;


class FileUpload extends BaseField
{

    public bool $multiple = false;
    public ?string $livewireComponent = null;
    public string $accept = "";
    public bool $confirm_delete = true;
    public ?string $confirm_msg = null; //defaults in blade class

    public $maxBytes = null;
    public $sizeLimitAlert;

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


    public function confirmDelete(null|string $message = null, bool $state = true): self
    {
        $this->confirm_delete = $state;
        if ($message) $this->confirm_msg = $message;
        return $this;
    }

}

