<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Planning;
use App\Models\Uic\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanningFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Planning::class;

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
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(30),
        ];
    }
}

