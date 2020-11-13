<?php


namespace Tanthammar\TallForms;


class ErrorMessage
{
    // in blade views to strip "form data" from field validation
    public static function parse($message)
    {
        $return = str_replace('form_data.', '', $message);
        return str_replace('form data.', '', $return);
    }
}
