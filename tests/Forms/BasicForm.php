<?php

namespace Tanthammar\TallForms\Tests\Forms;

use Tanthammar\TallForms\Input;
use Livewire\Component;
use Tanthammar\TallForms\TallForm;

class BasicForm extends Component {
    use TallForm;

    public function fields(): array {
        return [
            Input::make("Name", 'name'),
        ];
    }

}
