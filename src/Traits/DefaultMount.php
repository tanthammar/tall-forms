<?php

namespace Tanthammar\TallForms\Traits;

/**
 * Optional default mount method if you want to keep your components slim
 * @package Tanthammar\TallForms\Traits
 */
trait DefaultMount
{
    public function mount($model = null)
    {
        $this->mount_form($model);
    }
}
