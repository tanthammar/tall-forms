<?php


namespace Tanthammar\TallForms;


class ImageCropper extends BaseField
{
    public $includeScript = false;
    public $is_custom = true;
    public $type = 'single-croppie';
    public $width = 420;
    public $height = 340;
    public $resultContainer = 'w-full h-full';
    public $shape = 'square'; //or circle
    public $dropZoneHelp = 'Drag an image here or click in this area';

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

    public function resultContainer(string $class): self
    {
        $this->resultContainer = $class;
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
