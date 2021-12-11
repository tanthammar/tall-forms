<?php

namespace Tanthammar\TallForms\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Tanthammar\TallForms\Tests\App\Models\BasicFormModel;

class BasicFormModelFactory extends Factory
{
    protected $model = BasicFormModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
