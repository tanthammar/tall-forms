<?php


namespace Tanthammar\TallForms;


class ErrorMessage
{
    // in blade views to strip "form data" from field validation
    public static function parse($message)
    {
        return \Str::of($message)->replaceFirst('form_data', '')->replaceFirst('form data', '')->__toString();
    }
}
