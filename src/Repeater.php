<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\IsArrayField;

class Repeater extends BaseField
{
    use IsArrayField;

    public $labelEachRow = false;
    public $array_sortable = false;
    public $confirm_delete = false;
    public $confirm_msg = '';


    protected function overrides(): self
    {
        $this->type = 'array';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        $this->allowed_in_keyval = false;
        $this->inline = false;
        $this->wire = '';
        $this->defaultErrorPosition = false;
        return $this;
    }


    public function sortable(): self
    {
        $this->array_sortable = true;
        return $this;
    }

    public function labelEachRow(): self
    {
        $this->labelEachRow = true;
        return $this;
    }

    public function confirmDelete($message = ''): self
    {
        $this->confirm_delete = true;
        $this->confirm_msg = filled($message) ? $message : trans('tf::form.alerts.are-u-sure');
        return $this;
    }
}
