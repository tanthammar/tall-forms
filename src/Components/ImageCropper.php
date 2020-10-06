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

    public string $root = 'w-full p-4 mx-auto border-gray-300 border-2 border-gray-300 border-dashed rounded-lg relative hover:shadow-outline-gray';
    public string $wrapper = 'active:shadow-sm active:border-blue-500';
    public string $dropZone = 'cursor-pointer text-center uppercase text-sm text-bold text-gray-600';
    public string $fileInfo = 'text-xs text-gray-500';
    public string $icon = 'mx-auto h-12 w-12 text-gray-400';
    public string $cropper = 'fixed top-0 left-0 p-8 h-screen w-screen z-50 bg-white';
    public string $btnsRoot = 'z-10 absolute top-0 right-0 bottom-0 left-0';
    public string $btnsWrapper = 'flex gap-2 h-full w-full items-center justify-center';
    public string $editBtnWrapper = 'z-10 absolute top-0 right-0 bottom-0 left-0';
    public string $thumbnail = 'w-full h-full';
    //buttons
    public string $upload = 'flex items-center mx-auto mt-2 px-2 text-white text-sm text-center font-medium border border-transparent rounded outline-none bg-gray-500';
    public string $delete = 'bg-red-500 text-white p-2 rounded';
    public string $save = 'bg-teal-500 text-white p-2 rounded';
    public string $swap = 'bg-red-500 text-white p-2 rounded';
    public string $edit = 'bg-teal-500 text-white p-2 rounded';

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
