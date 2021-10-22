<?php

namespace Database\Factories\Uic;

use App\Models\Uic\RequirementRequest;
use App\Models\App\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RequirementRequest::class;

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
            'name' => $this->faker->word(),
            'required' => $this->faker->boolean(),
            'solicited' => $this->faker->boolean()
        ];
    }
}
