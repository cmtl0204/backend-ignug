<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Enrollment;
use App\Models\Uic\Modality;
use App\Models\Uic\SchoolPeriod;
use App\Models\Uic\MeshStudent;
use App\Models\Uic\State;
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
        $meshStudent = MeshStudent::get();
        $state = State::get();
        $planning = Planning::get();
        
        return [
            'modality_id' => $modalities[rand(0, sizeof($modalities) - 1)],
            'school_period_id' => $schoolPeriods[rand(0, sizeof($schoolPeriods) - 1)],
            'mesh_student_id' => $meshStudent[rand(0, sizeof($meshStudent) - 1)],
            'state_id' => $state[rand(0, sizeof($state) - 1)],
            'planning_id' => $planning[rand(0, sizeof($planning) - 1)],
            'registered_at' => $this->faker->date(),
            'code' => $this->faker->word(),
            'observations' => $this->faker->words(3)
        ];
    }
}

// $professionals = Professional::get();
// $types = Catalogue::where('type', 'COURSE_EVENT_TYPE')->get();
// $certifications = Catalogue::where('type', 'COURSE_CERTIFICATION_TYPE')->get();
// // $certifications = Catalogue::all()->only([58, 59]);
// $areas = Catalogue::where('type', 'COURSE_AREA')->get();

// return [
//     'code' => $this->faker->word(),
//     'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
//     'type_id' => $types[rand(0, sizeof($types) - 1)],
//     'certification_type_id' => $certifications[rand(0, sizeof($certifications) - 1)],
//     'area_id' => $areas[rand(0, sizeof($areas) - 1)],
//     'name' => $this->faker->word(),
//     'description' => $this->faker->text(30),
//     'started_at' => $this->faker->date(),
//     'ended_at' => $this->faker->date(),
//     'hours' => $this->faker->randomDigit(),
//     'institution' => $this->faker->word(),
// ];