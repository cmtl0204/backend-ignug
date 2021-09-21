<?php

namespace Database\Factories\JobBoard;

use App\Models\Model;
use App\Models\Core\Catalogue;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
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
        return [
            'professional_id'=> $professionals[rand(0, sizeof($professionals) - 1)],
            'type_id'=> '',
            'description'=> $this->faker->text()
        ];
    }
}
