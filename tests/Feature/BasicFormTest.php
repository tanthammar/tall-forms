<?php

use Tanthammar\TallForms\Tests\App\Http\Livewire\BasicForm;

use function Pest\Livewire\livewire;

it("can initialize a basic form component", function() {

    livewire(BasicForm::class)
        ->assertHasNoErrors()
        ->assertSee('Save & Go Back');

});
