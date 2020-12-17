<?php


namespace Tanthammar\TallForms;


class ImageCropper extends BaseField
{
    public $includeScript = false;
    public $is_custom = true;
    public $type = 'image-cropper';
    public $width = 420;
    public $height = 340;
    public $thumbnail;
    public $shape = 'square'; //or circle
    public $dropZoneHelp = 'Drag an image here or click in this area';
    public $fileInfo = 'PNG, JPG, GIF, TIFF, max 1.5MB';
    public $uploadButton = 'Select a file';
    public $align_label_top = true;
    public $allowed_in_repeater = false;
    public $allowed_in_keyval = false;
    public $allowed_in_tab = false;
    public $allowed_in_group = false;


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
    public function includeExternalScripts(): self
    {
        $this->includeScript = true;
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
