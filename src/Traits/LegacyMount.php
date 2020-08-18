<?php

namespace Tanthammar\TallForms\Traits;

/**
 * Mount method from v1
 * @package Tanthammar\TallForms\Traits
 */
trait LegacyMount
{
    public function mount($model = null, $action = 'update', $showDelete = false)
    {
        $this->model = $model;
        $this->beforeFormProperties();
        $this->setFormProperties($this->model);
        $this->action = $action;
        $this->showDelete = $showDelete;
        $this->setup();
        $this->previous = urlencode(\URL::previous());  //used for saveAndGoBack
    }
}
