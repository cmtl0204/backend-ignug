<?php

namespace Database\Factories\Uic;

use App\Models\Uic\TutorShip;
use App\Models\App\Career;
use App\Models\Uic\Enrollment;
use App\Models\Uic\Tutor;
use Illuminate\Database\Eloquent\Factories\Factory;

class TutorShipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TutorShip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tutors = Tutor::get();
        $enrollments = Enrollment::get();

        return [
            'tutor_id' => $tutors[rand(0, sizeof($tutors) - 1)],
            'enrollment_id' => $enrollments[rand(0, sizeof($enrollments) - 1)],
            'topics' => $this->faker->words(),
            'started_at' => $this->faker->date(),
            'time_started_at' => $this->faker->date(),
            'time_ended_at' => $this->faker->date(),
            'duration' => $this->faker->randomDigit(),
        ];
    }
}
