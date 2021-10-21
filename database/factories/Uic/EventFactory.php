<?php

namespace Database\Factories\Uic;

use App\Models\App\Catalogue;
use App\Models\Uic\Event;
use App\Models\Uic\Planning;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = Catalogue::get();
        $planning = Planning::get();
        
        return [
            'planning_id' => $planning[rand(0, sizeof($planning) - 1)],
            'name_id' => $name[rand(0, sizeof($name) - 1)],
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
        ];
    }
}
