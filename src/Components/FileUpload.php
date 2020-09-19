<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\FileUpload as Field;
use Tanthammar\TallForms\Traits\Helpers;

class FileUpload extends Component
{
    public Field $field;
    public string $spinnerWrapper = 'inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm';
    public string $ul = 'space-y-2 my-2';
    public string $li = 'w-full flex items-center px-2 py-1 border rounded';
    public string $thumbWrapper = 'border h-8 w-8 rounded-full';
    public string $thumbImg = 'h-8 w-full object-cover rounded-full';
    public string $iconWrapper = 'border h-8 w-8 rounded-full flex items-center justify-around';

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    public function class()
    {
        return "flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 rounded-none rounded-r-md";
    }

    public function inputWrapper()
    {
        $class = "my-1 flex rounded-md shadow-sm w-full relative ";
        $class .= $this->field->class;
        return Helpers::unique_words($class);
    }

    public function inputWrapperError()
    {
        return Helpers::unique_words($this->inputWrapper() . " border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red");
    }

    public function deleteButton()
    {
        return config('tall-forms.negative') . " rounded shadow p-2 text-white flex items-center";
    }

    public function render(): View
    {
        return view('tall-forms::components.file-upload');
    }
}
