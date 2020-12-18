<?php


namespace Tanthammar\TallForms\Exceptions;


class InvalidArrayFieldType extends \Exception
{
    public function __construct($fieldname, $fieldtype, $parenttype)
    {
        $lookup = [
            'array' => 'Repeater',
            'keyval' => 'Keyval',
            'tab' => 'Tab',,
            'group' => 'Group'
        ];

        parent::__construct(
            "Error for field: [$fieldname], type: [$fieldtype] is not allowed in [$lookup[$parenttype]]"
        );
    }
}
