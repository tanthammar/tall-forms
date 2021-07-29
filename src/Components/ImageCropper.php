<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\Helpers;

class ImageCropper extends Component
{

    public function __construct(
        public array|object $field,
        public ?string $imageUrl = '',
    ){
        $this->field = Helpers::mergeFilledToObject($this->defaults(), $field);
        $this->field->key = $this->field->key ?: $this->field->id;
        $this->field->name = $this->field->name ?: $this->field->id;
    }


    public function defaults(): array
    {
        return [
            'id' => 'imageCropper',
            'key' => null,
            'name' => null,
            'width' => 150,
            'height' => 150,
            'shape' => 'square',
            'dropZoneHelp' => __('tf::form.cropper.drop-zone-help'),
            'fileInfo' => __('tf::form.cropper.file-info'),
            'wrapperClass' => 'w-full',
            'uploadButton' => __('tf::form.cropper.select-file'),
            'thumbnail' => 'tf-cropper-thumb', //= h-full w-full
            'includeScript' => true,
            'imageUrl' => '',
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.image-cropper');
    }

}
