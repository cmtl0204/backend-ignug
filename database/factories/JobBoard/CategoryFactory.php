<?php

namespace Database\Factories\JobBoard;

use App\Models\Core\PrimeIcons;
use App\Models\JobBoard\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->ean8(),
            'name' => $this->faker->word(),
            'icon' => PrimeIcons::$icons[rand(0, sizeof(PrimeIcons::$icons)-1)],
        ];
    }
}
