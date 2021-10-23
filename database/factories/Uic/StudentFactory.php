<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Student;
use App\Models\App\Career;
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
        $projectsPlans = Career::get();
        
        return [
            'project_plan_id' => $projectsPlans[rand(0, sizeof($projectsPlans) - 1)],
            'mesh_student_id' => $this->whenPivotLoaded('mesh_student', function () {
                return $this->pivot->id;
            }),
            'observations' => $this->faker->words(3)
        ];
    }
}
