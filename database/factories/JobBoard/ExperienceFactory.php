<?php

namespace Database\Factories\JobBoard;

use App\Models\Model;
use App\Models\JobBoard\Professional;
use App\Models\Core\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $areas = Catalogue::where('type', 'AREA_EXPERIENCE')->get();
        return [
            'area_id' => $areas[rand(0, sizeof($areas) - 1)],
            'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
            'activities' => $this->faker->sentences(2),
            'employer' => $this->faker->word(),
            'end_at' => $this->faker->date(),
            'position' => $this->faker->word(),
            'reason_leave' => $this->faker->text(30),
            'start_at' => $this->faker->date(),
            'worked' => $this->faker->boolean(),
        ];
    }
}
