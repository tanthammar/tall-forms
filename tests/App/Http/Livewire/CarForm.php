<?php

namespace Tanthammar\TallForms\Tests\App\Http\Livewire;

use Tanthammar\TallForms\Input;
use Tanthammar\TallForms\TallFormComponent;
use Tanthammar\TallForms\Tests\App\Models\Car;

class CarForm extends TallFormComponent {

    public function mount(?Car $car)
    {
        //Gate::authorize()
        $this->mount_form($car); // $dummymodel from hereon, called $this->model
    }

    public function fields(): array {
        return [
            Input::make("Name", 'name')
                ->rules('required|min:3'),
        ];
    }

}
