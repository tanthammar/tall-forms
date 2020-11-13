<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\ImageCropper as Field;

class ImageCropper extends Component
{
    public Field $field;
    public string $imageUrl;

    public function __construct(Field $field, string $imageUrl = null)
    {
        $this->field = $field;
        $this->imageUrl = $imageUrl ?? "";
        $this->thumbnail = $field->thumbnail ?? 'tf-cropper-thumb'; //default = h-full w-full
    }

    public function render(): View
    {
        return view('tall-forms::components.image-cropper');
    }

}
