<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Tutor;
use App\Models\App\Career;
use App\Models\App\Teacher;
use App\Models\Core\Catalogue;
use App\Models\Uic\ProjectPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tutor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $projectPlans = ProjectPlan::get();
        $teachers = Teacher::get();
        $types = Catalogue::where('type', 'tutor')->get();

        return [
            'project_plan_id' => $projectPlans[rand(0, sizeof($projectPlans) - 1)],
            'teacher_id' => $teachers[rand(0, sizeof($teachers) - 1)],
            'type_id' => $types[rand(0, sizeof($types) - 1)],
            'observations' => $this->faker->words(3),
        ];
    }
}
