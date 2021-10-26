<?php


namespace Tanthammar\TallForms;


use Tanthammar\TallForms\Traits\CanBeDisabled;

class ImageCropper extends BaseField
{
    use CanBeDisabled;

    public bool $includeScript = false;
    public $width;
    public $height;
    public $thumbnail;
    public $shape; //square or circle
    public $dropZoneHelp;
    public $fileInfo;
    public $uploadButton;


    protected function overrides(): self
    {
        $this->type = 'image-cropper';
        $this->is_custom = true;
        $this->align_label_top = true;
        $this->allowed_in_repeater = true;
        $this->allowed_in_keyval = true;
        $this->includeScript = config('tall-forms.include-external-scripts');
        return $this;
    }

    public function dropZoneHelp(string $text): self
    {
        $this->dropZoneHelp = $text;
        return $this;
    }

    public function fileInfo(string $text): self
    {
        $this->fileInfo = $text;
        return $this;
    }

    public function uploadButton(string $text): self
    {
        $this->uploadButton = $text;
        return $this;
    }

    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     * Only pushed once
     */
    public function includeExternalScripts(bool $state = true): self
    {
        $this->includeScript = $state;
        return $this;
    }

    /**
     * Image preview size (class) in relation to its container
     * @param string $class
     * @return $this
     */
    public function thumbnail(string $class): self
    {
        $this->thumbnail = $class;
        return $this;
    }

    /**
     * Cropper width in pixels
     * @param int $pixels
     * @return $this
     */
    public function width(int $pixels): self
    {
        $this->width = $pixels;
        return $this;
    }

    /**
     * Cropper height in pixels
     * @param int $pixels
     * @return $this
     */
    public function height(int $pixels): self
    {
        $this->height = $pixels;
        return $this;
    }

    /**
     * Circular cropper shape
     * @return $this
     */
    public function circle(): self
    {
        $this->shape = 'circle';
        return $this;
    }

    /**
     * Square cropper shape
     * @return $this
     */
    public function square(): self
    {
        $this->shape = 'square';
        return $this;
    }

}
