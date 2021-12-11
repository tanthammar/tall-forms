<?php

use Tanthammar\TallForms\Tests\App\Http\Livewire\BasicForm;
use Tanthammar\TallForms\Tests\App\Models\BasicFormModel;

use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertTrue;

it("can initialize a basic form and set name to validate change", function() {

    $basicForm = BasicFormModel::factory()->create([]);

    $newName = "Professor Calculus";

    livewire(BasicForm::class, ['basicForm' => $basicForm])
        ->set('form_data.name', $newName)
        ->call('saveAndStay')
        ->assertHasNoErrors();

    assertTrue(BasicFormModel::whereName($newName)->exists());

});
