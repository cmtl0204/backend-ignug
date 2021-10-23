<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Student;
use App\Models\App\Career;
use App\Models\Uic\ProjectPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projectsPlans = ProjectPlan::get();
        
        return [
            // 'project_plan_id' => $projectsPlans[rand(0, sizeof($projectsPlans) - 1)],
            'project_plan_id' => 1,
            // 'mesh_student_id' => 1,
            'observations' => $this->faker->words(3)
        ];
    }
}
