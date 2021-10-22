<?php

namespace Database\Factories\Uic;

use App\Models\App\Career;
use App\Models\App\Mesh;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeshFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mesh::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $careers = Career::get();
        
        return [
            'career_id' => $careers[rand(0, sizeof($careers) - 1)],
            'name' => $this->faker->uuid(),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
            'resolution_number' => $this->faker->uuid(),
            'number_weeks' => $this->faker->randomDigit(),
        ];
    }
}