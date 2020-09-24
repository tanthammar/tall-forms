<?php


namespace Tanthammar\TallForms;


class ConfigAttr
{
    /**
     * Had to add this class and method because of this issue: https://github.com/livewire/livewire/issues/1653
     * @param $type
     * @return array|mixed
     */
    public static function key($type)
    {
        return data_get(config('tall-forms.component-attributes'), $type, []);
    }
}
