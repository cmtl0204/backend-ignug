<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Project;
use App\Models\Uic\Enrollment;
use App\Models\Uic\ProjectPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $enrollments = Enrollment::get();
        $projectPlans = ProjectPlan::get();
        
        return [
            'enrollment_id' => $enrollments[rand(0, sizeof($enrollments) - 1)],
            'project_plan_id' => $projectPlans[rand(0, sizeof($projectPlans) - 1)],
            'title' => $this->faker->word(),
            'description' => $this->faker->text(30),
            'tutor_asigned' => $this->faker->word(),
            'total_advance' => $this->faker->word(),
            'score' => $this->faker->randomDigit(),
            'approved' => $this->faker->boolean(),
            'observations' => $this->faker->words(3),
        ];
    }
}
