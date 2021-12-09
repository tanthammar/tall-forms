<?php

namespace Tanthammar\TallForms\Tests\Forms;

use Tanthammar\TallForms\Input;
use Livewire\Component;

class BasicForm extends Component {

    public function fields(): array {
        return [
            Input::make("Name", 'name'),
        ];
    }

}
