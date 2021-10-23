<?php

namespace Database\Factories\Uic;

use App\Models\Uic\RequirementRequest;
use App\Models\App\Career;
use App\Models\Uic\Requirement;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequirementRequestFactory extends Factory
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
        $requirements = Requirement::get();

        return [
            'requirement_id' => $requirements[rand(0, sizeof($requirements) - 1)],
            'mesh_student_id' => $this->whenPivotLoaded('mesh_student', function () {
                return $this->pivot->id;
            }),
            'registered_at' => $this->faker->date(),
            'approved' => $this->faker->boolean(),
            'observations' => $this->faker->words()
        ];
    }
}
