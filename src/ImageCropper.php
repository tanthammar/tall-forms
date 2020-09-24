<?php


namespace Tanthammar\TallForms;


class ImageCropper extends BaseField
{
    public $includeScript = false;
    public $is_custom = true;
    public $type = 'single-croppie';
    public $width = 300;
    public $height = 300;
    public $shape = 'square'; //or circle

    public function getCropperAttributesProperty(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'shape' => $this->shape,
        ];
    }


    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     */
    public function pushScriptLinks(): self
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
