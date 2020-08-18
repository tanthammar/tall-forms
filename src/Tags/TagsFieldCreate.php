<?php

namespace Tanthammar\TallForms\Tags;

use Livewire\Component;

class TagsFieldCreate extends Component
{
    use TagsTrait;

    public function mount(string $field, string $tagType = null, string $tags = null, string $help = null, string $errorMsg = null)
    {
        $this->model = null;
        $this->tags_mount($field, $tagType, $tags, $help, $errorMsg);
    }
}
