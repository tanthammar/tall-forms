<?php

namespace Tanthammar\TallForms\Controllers;

use App\Http\Controllers\Controller;

class FileUpload extends Controller
{

    /**
     * @return mixed
     */
    public function __invoke()
    {
        return call_user_func([request()->input('component'), 'fileUpload']);
    }
}
