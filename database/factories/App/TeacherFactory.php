<?php

namespace Database\Factories\Uic;

use App\Models\App\Teacher;
use App\Models\Authentication\User;
use App\Models\Core\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::get();
        $teachingLadders = Catalogue::where('type', 'EVENT_NAME')->get();
        $dedicationTimes = Catalogue::where('type', 'EVENT_NAME')->get();
        $higherEducations = Catalogue::where('type', 'EVENT_NAME')->get();
        $countryHigherEducations = Catalogue::where('type', 'EVENT_NAME')->get();
        $scholarships = Catalogue::where('type', 'EVENT_NAME')->get();
        $scholarshipTypes = Catalogue::where('type', 'EVENT_NAME')->get();
        $financingTypes = Catalogue::where('type', 'EVENT_NAME')->get();
        
        return [
            'user_id' => $users[rand(0, sizeof($users) - 1)],
            'teaching_ladder_id' => $teachingLadders[rand(0, sizeof($teachingLadders) - 1)],
            'dedication_time_id' => $dedicationTimes[rand(0, sizeof($dedicationTimes) - 1)],
            'higher_education_id' => $higherEducations[rand(0, sizeof($higherEducations) - 1)],
            'country_higher_education_id' => $countryHigherEducations[rand(0, sizeof($countryHigherEducations) - 1)],
            'scholarship_id' => $scholarships[rand(0, sizeof($scholarships) - 1)],
            'scholarship_type_id' => $scholarshipTypes[rand(0, sizeof($scholarshipTypes) - 1)],
            'financing_type_id' => $financingTypes[rand(0, sizeof($financingTypes) - 1)],
            'total_subjects' => $this->faker->randomDigit(),
            'hours_worked' => $this->faker->randomDigit(),
            'class_hours' => $this->faker->randomDigit(),
            'investigation_hours' => $this->faker->randomDigit(),
            'administrative_hours' => $this->faker->randomDigit(),
            'community_hours' => $this->faker->randomDigit(),
            'other_hours' => $this->faker->randomDigit(),
            'total_publications' => $this->faker->randomDigit(),
            'scholarship_amount' => $this->faker->randomDigit(),
            'technical' => $this->faker->boolean(),
            'technology' => $this->faker->boolean(),
            'sabbatical' => $this->faker->boolean(),
            'publications' => $this->faker->boolean(),
            'academic_unit' => $this->faker->word(),
            'institution_higher_education' => $this->faker->word(),
            'degree_higher_education' => $this->faker->word(),
            'start_sabbatical' => $this->faker->date(),
        ];
    }
}