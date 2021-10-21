<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Modality;
use App\Models\Core\State;
use App\Models\App\Career;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * 
     */
    public function definition()
    {
        $modalities = Modality::get();
        $states = State::get();
        $careers = Career::get();
        
        return [
            'parent_id' => $modalities[rand(0, sizeof($modalities) - 1)],
            'state_id' => $states[rand(0, sizeof($states) - 1)],
            'career_id' => $careers[rand(0, sizeof($careers) - 1)],
            'name' => $this->faker->word(),
            'description' => $this->faker->text(30),
        ];
    }
}

