<?php


namespace Tanthammar\TallForms;


class ImageCropper extends BaseField
{
    public $includeScript = false;
    public $is_custom = true;
    public $type = 'image-cropper';
    public $width = 420;
    public $height = 340;
    public $thumbnailClass = 'w-full h-full';
    public $shape = 'square'; //or circle
    public $dropZoneHelp = 'Drag an image here or click in this area';
    public $fileInfo = 'PNG, JPG, GIF, TIFF, max 1.5MB';
    public $uploadButton = 'Select a file';
    public $align_label_top = true;
    public $allowed_in_array = false;


    public function getCropperAttributesProperty(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'shape' => $this->shape,
        ];
    }

    public function dropZoneHelp($text)
    {
        $this->dropZoneHelp = $text;
        return $this;
    }

    public function fileInfo($text)
    {
        $this->fileInfo = $text;
        return $this;
    }

    public function uploadButton($text)
    {
        $this->uploadButton = $text;
        return $this;
    }

    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     */
    public function includeExternalScripts(): self
    {
        $this->includeScript = true;
        return $this;
    }

    public function width(int $pixels): self
    {
        $this->width = $pixels;
        return $this;
    }

    public function height(int $pixels): self
    {
        $this->height = $pixels;
        return $this;
    }

    public function thumbnailClass(string $class): self
    {
        $this->thumbnailClass = $class;
        return $this;
    }

    public function circle(): self
    {
        $this->shape = 'circle';
        return $this;
    }

    public function square(): self
    {
        $this->shape = 'square';
        return $this;
    }

}
