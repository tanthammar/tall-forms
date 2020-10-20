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

    public string $root = 'bg-white border-2 border-dashed border-gray-300 mx-auto p-4 relative rounded w-full';
    public string $wrapper = 'active:border-blue-500';
    public string $dropZone = 'cursor-pointer font-bold text-center text-gray-400 text-xs tracking-wide uppercase';
    public string $fileInfo = 'font-hairline text-gray-500 text-xs';
    public string $icon = 'mx-auto h-12 w-12 text-gray-400';
    public string $modalbg = 'fixed inset-0 h-screen w-screen p-2 sm:p-10 md:p-20 bg-gray-800 bg-opacity-75 z-50';
    public string $modal = 'bg-white rounded w-full h-full flex justify-center items-center';
    public string $btnsRoot = 'z-10 absolute inset-0';
    public string $btnsWrapper = 'flex gap-2 h-full w-full items-center justify-center';
    public string $editBtnWrapper = 'z-10 absolute inset-0';
    public string $thumbnail = 'w-full h-full';
    //buttons
    public string $upload = 'bg-gray-400 flex font-medium items-center mt-2 mx-auto outline-none px-2 rounded-sm text-center text-white text-xs';
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
