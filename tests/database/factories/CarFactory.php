<?php

namespace Tanthammar\TallForms\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tanthammar\TallForms\Tests\App\Models\Car;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
