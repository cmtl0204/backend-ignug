<?php

namespace Database\Factories;

use App\Models\Catalogue;
use App\Models\PrimeIcons;
use Illuminate\Database\Eloquent\Factories\Factory;

class CatalogueFactory extends Factory
{

    protected $model = Catalogue::class;

    public function definition()
    {
        return [
            'code' => $this->faker->ean8(),
            'name' => $this->faker->sentence(),
            'type' => $this->faker->word(),
            'icon' => PrimeIcons::$icons[rand(0, sizeof(PrimeIcons::$icons))],
            'color' => $this->faker->hexColor(),
        ];
    }
}
