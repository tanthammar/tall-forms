<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait UploadsFiles
{
    public $showFileUploadError = false;

    public function clearFileUploadError(string $field)
    {
        $this->resetErrorBag($field);
    }

    public function getFileErrorProperty()
    {
        return isset($this->uploadFileError)
            ? $this->uploadFileError
            : trans(config('tall-forms.upload-file-error'));
    }

    /**
     * @param string $field_name
     * @param string|array $rules
     */
    public function customValidateFilesIn($field_name, $rules)
    {
        if(filled($this->$field_name) && filled($rules)) {
            $key = is_array($this->$field_name) ? $field_name.'.*' : $field_name;
            try {
                Validator::make([$field_name => $this->$field_name], [
                    $key => $rules,
                ])->validate();
                $this->showFileUploadError = false;
            } catch (ValidationException $e) {
                $this->showFileUploadError = true;
                $this->clearFieldAndDeleteTempFiles($field_name);
            }
        }
    }

    /**
     * RESETS THE FIELD and DELETES all TEMPORARY files.
     * Don't call this before you saved the files you want to keep.
     * @param $field_name
     */
    public function clearFieldAndDeleteTempFiles($field_name)
    {
        if ($this->deleteAllTempFiles($this->$field_name)) $this->$field_name = null;
    }

    public function deleteSingleTempFile($field_name, $key)
    {
        if (is_array($this->$field_name)) {
            if (filled($file = data_get($this->$field_name, $key))) {
                if ($file->delete()) $this->arrayRemove($field_name, $key, false);
            }
        } else {
            if (filled($file = $this->$field_name)) $file->delete();
            $this->$field_name = null;
        }
    }

    /**
     * DELETES all TEMPORARY files.
     * Don't call this before you saved the files you want to keep.
     * @param $files
     * @return bool
     */
    public function deleteAllTempFiles($files): bool
    {
        $success = false;
        if (filled($files)) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (filled($file)) $success = $file->delete();
                }
            } else {
                $success = $files->delete();
            }
        }
        return $success;
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
