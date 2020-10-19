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

    public string $root = 'w-full p-4 mx-auto border-gray-300 border bg-white rounded relative';
    public string $wrapper = 'active:border-blue-500';
    public string $dropZone = 'cursor-pointer text-center uppercase text-sm text-bold text-gray-700';
    public string $fileInfo = 'text-xs text-gray-600';
    public string $icon = 'mx-auto h-12 w-12 text-gray-400';
    public string $modalbg = 'fixed inset-0 h-screen w-screen p-2 sm:p-10 md:p-20 bg-gray-800 bg-opacity-75 z-50';
    public string $modal = 'bg-white rounded w-full h-full flex justify-center items-center';
    public string $btnsRoot = 'z-10 absolute inset-0';
    public string $btnsWrapper = 'flex gap-2 h-full w-full items-center justify-center';
    public string $editBtnWrapper = 'z-10 absolute inset-0';
    public string $thumbnail = 'w-full h-full';
    //buttons
    public string $upload = 'flex items-center mx-auto mt-2 px-2 text-white text-sm text-center font-medium border border-transparent rounded outline-none bg-gray-500';
    public string $delete = 'bg-red-500 text-white p-2 rounded';
    public string $save = 'bg-teal-500 text-white p-2 rounded';
    public string $swap = 'bg-red-500 bg-opacity-75 hover:bg-opacity-100 text-white p-2 rounded';
    public string $edit = 'bg-teal-500 bg-opacity-75 hover:bg-opacity-100 text-white p-2 rounded';

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
