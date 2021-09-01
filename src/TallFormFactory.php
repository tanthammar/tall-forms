<?php

namespace Tanthammar\TallForms;

use Illuminate\Database\Eloquent\Factories\Factory;

class TallFormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TallFormModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return TallFormModel::defaults();
    }
}
