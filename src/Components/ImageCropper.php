<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Tanthammar\TallForms\Traits\BaseBladeField;

class ImageCropper extends BaseBladeField
{

    public function __construct(
        public array|object $field,
        public ?string      $imageUrl = '',
    )
    {
        parent::__construct((array)$field);
    }


    public function defaults(): array
    {
        return [
            'id' => 'imageCropper',
            'width' => 150,
            'height' => 150,
            'shape' => 'square',
            'dropZoneHelp' => __('tf::form.cropper.drop-zone-help'),
            'fileInfo' => __('tf::form.cropper.file-info'),
            'wrapperClass' => 'w-full',
            'uploadButton' => __('tf::form.cropper.select-file'),
            'thumbnail' => 'tf-cropper-thumb', //= h-full w-full
            'includeScript' => true,
            'disabled' => false,
        ];
    }

    public function render(): View
    {
        return view('tall-forms::components.image-cropper');
    }

}
