<?php

namespace Tanthammar\TallForms\Tests\App\Http\Livewire;

use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\TallFormComponent;
use Tanthammar\TallForms\Tests\App\Models\BasicFormModel;

class BasicForm extends TallFormComponent {

    public function mount(?BasicFormModel $basicForm)
    {
        //Gate::authorize()
        $this->mount_form($basicForm); // $dummymodel from hereon, called $this->model
    }

    public function fields(): array {
        return [
            Input::make("Name", 'name'),
        ];
    }

}
