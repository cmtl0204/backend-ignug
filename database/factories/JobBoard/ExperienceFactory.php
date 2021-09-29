<?php

namespace Database\Factories\JobBoard;

use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Experience;
use App\Models\Core\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $areas = Catalogue::where('type', 'EXPERIENCE_AREA')->get();
        return [
            'area_id' => $areas[rand(0, sizeof($areas) - 1)],
            'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
            'activities' => $this->faker->sentences(2),
            'employer' => $this->faker->word(),
            'ended_at' => $this->faker->date(),
            'position' => $this->faker->word(),
            'reason_leave' => $this->faker->text(30),
            'started_at' => $this->faker->date(),
            'worked' => $this->faker->boolean()
        ];
    }
}
