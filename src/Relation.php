<?php


namespace Tanthammar\TallForms;


class Relation extends BaseField
{
    public $is_relation = false;

    public function relation(): self
    {
        $this->is_relation = true;
        return $this;
    }

}
