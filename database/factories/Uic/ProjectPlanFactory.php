<?php

namespace Database\Factories\Uic;

use App\Models\Uic\ProjectPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProjectPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->text(30),
            'act_code' => $this->faker->uuid(),
            'approved_at' => $this->faker->date(),
            'approved' => $this->faker->boolean(),
            'observations' => $this->faker->words(3),
        ];
    }
}

