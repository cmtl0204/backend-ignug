<?php

namespace Database\Factories\Uic;

use App\Models\App\SchoolPeriod;
use App\Models\App\Teacher;
use App\Models\Authentication\User;
use App\Models\Core\Catalogue;
use App\Models\Core\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolPeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolPeriod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $states = State::get();
        
        return [
            'state_id' => $states[rand(0, sizeof($states) - 1)],
            'code' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'started_at' => $this->faker->dat|e(),
            'ended_at' => $this->faker->date(),
            'ordinary_started_at' => $this->faker->date(),
            'ordinary_ended_at' => $this->faker->date(),
            'extraordinary_started_at' => $this->faker->date(),
            'extraordinary_ended_at' => $this->faker->date(),
            'especial_started_at' => $this->faker->date(),
            'especial_ended_at' => $this->faker->date(),
        ];
    }
}