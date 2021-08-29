<?php

namespace Tanthammar\TallForms;

abstract class TallFormWithoutButtons extends TallFormComponent
{
    public bool $showSave = false;
    public bool $showDelete = false;
    public bool $showReset = false;
    public bool $showGoBack = false;
    public $wrapWithView = false;
}
