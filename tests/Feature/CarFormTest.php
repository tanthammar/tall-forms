<?php

use Tanthammar\TallForms\Tests\App\Http\Livewire\CarForm;

use function Pest\Livewire\livewire;

it("can initialize a basic form component", function() {

    livewire(CarForm::class)
        ->assertHasNoErrors()
        ->assertSee('Save & Go Back');

});
