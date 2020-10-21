<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\ImageCropper as Field;

class ImageCropper extends Component
{
    public Field $field;
    public string $temp_key;
    public string $imageUrl;

    public function __construct(Field $field, string $tempKey, string $imageUrl = null)
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->imageUrl = $imageUrl ?? "";
        $this->thumbnail = $field->thumbnail ?? $this->thumbnail;
    }

    public function render(): View
    {
        return view('tall-forms::components.image-cropper');
    }

}
