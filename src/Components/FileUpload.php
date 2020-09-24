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
    public string $uploadFileError;
    public bool $showFileUploadError;
    public ?string $showFileUploadErrorFor;
    public $fieldValue;

    public function __construct(Field $field,
                                bool $showFileUploadError,
                                ?string $showFileUploadErrorFor,
                                $fieldValue = null)
    {
        $this->field = $field;
        $this->uploadFileError = data_get($field, 'errorMsg') ?? (string) trans(config('tall-forms.upload-file-error'));
        $this->showFileUploadError = $showFileUploadError;
        $this->showFileUploadErrorFor = $showFileUploadErrorFor;
        $this->fieldValue = $fieldValue;
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
        return Helpers::unique_words($this->inputWrapper() . " border-red-300 text-red-900 placeholder-red-300 shadow-outline-red");
    }

    public function deleteButton()
    {
        return config('tall-forms.negative') . " rounded shadow p-2 text-white flex items-center";
    }

    public function render(): View
    {
        return view('tall-forms::components.file-upload');
    }
    public function fileIcon($mime_type)
    {
        $icons = [
            'image' => 'file-image',
            'audio' => 'file-audio',
            'video' => 'file-video',
            'application/pdf' => 'file-pdf',
            'application/msword' => 'file-word',
            'application/vnd.ms-word' => 'file-word',
            'application/vnd.oasis.opendocument.text' => 'file-word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'file-word',
            'application/vnd.ms-excel' => 'file-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'file-excel',
            'application/vnd.oasis.opendocument.spreadsheet' => 'file-excel',
            'application/vnd.ms-powerpoint' => 'file-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml' => 'file-powerpoint',
            'application/vnd.oasis.opendocument.presentation' => 'file-powerpoint',
            'text/plain' => 'file-alt',
            'text/html' => 'file-code',
            'application/json' => 'file-code',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'file-word',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'file-excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'file-powerpoint',
            'application/gzip' => 'file-archive',
            'application/zip' => 'file-archive',
            'application/x-zip-compressed' => 'file-archive',
            'application/octet-stream' => 'file-archive',
        ];

        if (isset($icons[$mime_type])) return $icons[$mime_type];
        $mime_group = explode('/', $mime_type, 2)[0];

        return (isset($icons[$mime_group])) ? $icons[$mime_group] : 'file';
    }
}
