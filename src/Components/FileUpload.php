<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Traits\BaseBladeField;
use Tanthammar\TallForms\Traits\Helpers;

class FileUpload extends Component
{
    use Helpers;

    public function __construct(
        public array|object $field,
        public ?bool $showFileUploadError = false,
        public ?string $showFileUploadErrorFor = null,
        public ?string $uploadFileError = null)
    {
        $this->field = BaseBladeField::setDefaults($this->defaults(), $field);
        $this->uploadFileError = data_get($field, 'errorMsg', $this->field->uploadFileError);
        $this->showFileUploadErrorFor = $this->showFileUploadErrorFor ?: $this->field->key;
        $this->field->inputWrapperClass = $this->inputWrapper();
    }

    public function defaults(): array
    {
        return [
            'id' => 'fileUpload',
            'multiple' => false,
            'class' => '',
            'confirm_delete' => true,
            'confirm_msg' => __('tf::form.alerts.are-u-sure'),
            'accept' => 'image/*',
            'uploadFileError' => __('tf::form.file-upload.upload-file-error'),
            'fieldValue' => null,
            'tall_svg_upload' => config('tall-forms.file-upload'),
            'tall_svg_file' => config('tall-forms.file-icon'),
            'tall_svg_trash' => config('tall-forms.trash-icon'),
            'inputWrapperClass' => 'tf-file-upload-input-wrapper',
            'inputWrapperErrorClass' => 'tf-field-error',
        ];
    }

    public function class(): string
    {
        return "form-input tf-file-upload";
    }

    public function inputWrapper(): string
    {
        if (filled($this->field->class)) {
            $class = $this->field->inputWrapperClass;
            $class .= " ";
            $class .= $this->field->class;
            return Helpers::unique_words($class);
        }
        return $this->field->inputWrapperClass;
    }

    public function inputWrapperError(): string
    {
        return "$this->field->inputWrapperClass $this->field->inputWrapperErrorClass";
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
