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
    public string $sizeLimitAlert;


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

    // TODO Waiting for livewire v2 bugfix to .defer on file uploads, see file.blade.php
    // https://github.com/livewire/livewire/issues/1461
    // tested, working except for livewire bug
    /**
     * Validates filesize in frontend and prevents upload <br>
     * Observe that this is not a replacement for field validation rules!
     * @param int $bytes
     * @return $this
     */
//    public function max_bytes(int $bytes): self
//    {
//        $this->maxBytes = $bytes;
//        return $this;
//    }

    /**
     * If the file size is larger than allowed max_bytes, <br>
     * alert this message <br>
     * Observe that this is not a replacement for field validation rules!
     * @param string $message
     * @return $this
     */
//    public function size_limit_alert(string $message): self
//    {
//        $this->sizeLimitAlert = $message;
//        return $this;
//    }
}

