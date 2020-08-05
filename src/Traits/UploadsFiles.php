<?php

namespace Tanthammar\TallForms\Traits;

trait UploadsFiles
{
    public static function fileUpload()
    {
        $storage_disk = self::$storage_disk ?? config('tall-forms.storage_disk');
        $storage_path = self::$storage_path ?? config('tall-forms.storage_path');
        $files = [];

        foreach (request()->file('files') as $file) {
            $files[] = [
                'file' => $file->store($storage_path, $storage_disk),
                'disk' => $storage_disk,
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ];
        }

        return ['field_name' => request()->input('field_name'), 'uploaded_files' => $files];
    }

    public function fileUpdate($field_name, $uploaded_files)
    {
        foreach ($this->fields() as $field) {
            if ($field->name == $field_name) {
                $value = $field->file_multiple ? array_merge($this->form_data[$field_name], $uploaded_files) : $uploaded_files;
                break;
            }
        }

        $this->form_data[$field_name] = $value ?? [];
        $this->updated('form_data.' . $field_name);
    }

    public function fileIcon($mime_type)
    {
        $icons = [
            'image' => 'image',
            'audio' => 'audio',
            'video' => 'video',
            'application/pdf' => 'pdf',
            'application/msword' => 'word',
            'application/vnd.ms-word' => 'word',
            'application/vnd.oasis.opendocument.text' => 'word',
            'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'word',
            'application/vnd.ms-excel' => 'excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'excel',
            'application/vnd.oasis.opendocument.spreadsheet' => 'excel',
            'application/vnd.ms-powerpoint' => 'powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml' => 'powerpoint',
            'application/vnd.oasis.opendocument.presentation' => 'powerpoint',
            'text/plain' => 'alt',
            'text/html' => 'code',
            'application/json' => 'code',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'word',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'powerpoint',
            'application/gzip' => 'archive',
            'application/zip' => 'archive',
            'application/x-zip-compressed' => 'archive',
            'application/octet-stream' => 'archive',
        ];

        if (isset($icons[$mime_type])) return $icons[$mime_type];
        $mime_group = explode('/', $mime_type, 2)[0];

        return (isset($icons[$mime_group])) ? $icons[$mime_group] : 'file';
    }
}
