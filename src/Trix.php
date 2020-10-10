<?php


namespace Tanthammar\TallForms;


class Trix extends BaseField
{
    public $type = 'trix';
    public bool $includeScript = false;

    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     * Only pushed once
     */
    public function includeExternalScripts(): self
    {
        $this->includeScript = true;
        return $this;
    }
}
