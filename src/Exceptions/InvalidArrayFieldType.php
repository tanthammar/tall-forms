<?php


namespace Tanthammar\TallForms\Exceptions;


class InvalidArrayFieldType extends \Exception
{
    public function __construct($fieldname, $fieldtype)
    {
        parent::__construct(
            "You can not add field type [{$fieldtype}] to Repeater or KeyVal field: [{$fieldname}]"
        );
    }
}
