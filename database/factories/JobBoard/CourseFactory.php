<?php

namespace Database\Factories\JobBoard;

use App\Models\Core\Catalogue;
use App\Models\JobBoard\Course;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $types = Catalogue::where('type', 'COURSE_EVENT_TYPE')->get();
        $certifications = Catalogue::where('type', 'COURSE_CERTIFICATION_TYPE')->get();
        // $certifications = Catalogue::all()->only([58, 59]);
        $areas = Catalogue::where('type', 'COURSE_AREA')->get();

        return [
            'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
            'type_id' => $types[rand(0, sizeof($types) - 1)],
            'certification_type_id' => $certifications[rand(0, sizeof($certifications) - 1)],
            'area_id' => $areas[rand(0, sizeof($areas) - 1)],
            'name' => $this->faker->word(),
            'description' => $this->faker->text(30),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
            'hours' => $this->faker->randomDigit(),
            'institution' => $this->faker->word(),
        ];
    }
}
