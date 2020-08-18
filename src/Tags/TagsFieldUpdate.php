<?php

namespace Tanthammar\TallForms\Tags;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TagsFieldUpdate extends Component
{
    use TagsTrait;

    public function mount(Model $model, string $field, string $tagType = null, string $tags = null, string $help = null, string $errorMsg = null)
    {
        $this->model = $model;
        $this->tags_mount($field, $tagType, $tags, $help, $errorMsg);
    }
}
