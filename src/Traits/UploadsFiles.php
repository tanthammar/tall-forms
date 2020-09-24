<?php

namespace Tanthammar\TallForms\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait UploadsFiles
{
    public $showFileUploadError = false;
    public $showFileUploadErrorFor = '';

    public function clearFileUploadError(string $field)
    {
        $this->resetErrorBag($field);
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
                $this->showFileUploadErrorFor = $field_name;
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
}
