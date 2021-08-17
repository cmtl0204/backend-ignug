<?php

namespace Database\Factories;

use App\Models\PrimeIcons;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->word(),
            'icon' => PrimeIcons::$icons[rand(0, sizeof(PrimeIcons::$icons))],
            'router_link' => $this->faker->url(),
        ];
    }
}
