<?php

return [
    'form-title' => "trans('global.create').' '.trans('crud.dummymodel.title_singular')",
    'storage_disk' => env('FORM_STORAGE_DISK', 'public'),
    'storage_path' => env('FORM_STORAGE_PATH', 'uploads'),
    'arrow-up-icon' => 'light/arrow-up', //used as @svg('light/arrow-up', 'classes')
    'arrow-down-icon' => 'light/arrow-down',
    'trash-icon' => 'light/trash-alt',
    'plus-icon' => 'light/plus-circle',
    'file-icon' => 'light/file-' //used as light/file-{$value['mime_type']}
];
