<?php

namespace Database\Factories\LicenseWork;

use App\Models\LicenseWork\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class DependenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
        ];
    }
}
