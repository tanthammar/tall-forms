<?php

use Tanthammar\TallForms\Tests\App\Http\Livewire\CarForm;
use Tanthammar\TallForms\Tests\App\Models\Car;

use function Pest\Livewire\livewire;
use function PHPUnit\Framework\assertTrue;

it("can initialize a basic form and set name to validate change", function() {

    // create a car object from the factory
    $car = Car::factory()->create([
        'name' => 'Volvo XC60',
    ]);

    // prepare to save a new name to the object
    $newName = "Saab 9-3";

    livewire(CarForm::class, ['car' => $car]) // instance the form with the model
        ->set('form_data.name', $newName) // set the name field
        ->call('saveAndStay') // call for save
        ->assertHasNoErrors(); // nothing should break

    assertTrue(Car::whereName($newName)->exists()); // there is a car in the db with a new name
    assertTrue(Car::whereName($newName)->first()->id == 1); // ensure not a new object in db

});

it("can require car name with length > 3", function() {

    // create a car object from the factory
    $car = Car::factory()->create([
        'name' => 'Saab 9-3',
    ]);

    // prepare to save a new name that is to short to the object, there whould be some error
    $newName = "iX";

    livewire(CarForm::class, ['car' => $car])
        ->set('form_data.name', $newName)
        ->call('saveAndStay')
        ->assertHasErrors('form_data.name'); // check for an required/min:3 error
});

it("can require a name to the car", function() {

    livewire(CarForm::class, ['car' => Car::factory()->create()])
        ->set('form_data.name', null)
        ->call('saveAndStay')
        ->assertHasErrors('form_data.name'); // check for an required error

});
