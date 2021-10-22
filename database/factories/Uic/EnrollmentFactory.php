<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Enrollment;
use App\Models\Uic\Modality;
use App\Models\App\SchoolPeriod;
use App\Models\Uic\MeshStudent;
use App\Models\Core\State;
use App\Models\Uic\Planning;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $modalities = Modality::get();
        $schoolPeriods = SchoolPeriod::get();
        $states = State::get();
        $plannings = Planning::get();
        
        return [
            'modality_id' => $modalities[rand(0, sizeof($modalities) - 1)],
            'school_period_id' => $schoolPeriods[rand(0, sizeof($schoolPeriods) - 1)],
            'mesh_student_id' => $this->whenPivotLoaded('mesh_student', function () {
                return $this->pivot->id;
            }),
            'state_id' => $states[rand(0, sizeof($states) - 1)],
            'planning_id' => $plannings[rand(0, sizeof($plannings) - 1)],
            'registered_at' => $this->faker->date(),
            'code' => $this->faker->word(),
            'observations' => $this->faker->words(3)
        ];
    }
}