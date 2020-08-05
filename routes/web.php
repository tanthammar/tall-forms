<?php

Route::group(['middleware' => 'web'], function () {
//    Route::post('/tall-forms/file-upload', function () {
//        return call_user_func([request()->input('component'), 'fileUpload']);
//    })->name('tall-forms.file-upload');

    Route::post('/tall-forms/file-upload', \Tanthammar\TallForms\Controllers\FileUpload::class)->name('tall-forms.file-upload');
});
