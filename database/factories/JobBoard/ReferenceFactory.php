<?php

namespace Database\Factories\JobBoard;

use App\Models\Model;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceFactory extends Factory
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
        $contactPhone=$this->faker->randomNumber(10, true);
        return [
            'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
            'position'=>$this->faker->word(),
            'contact_name'=>$this->faker->word(),
            'contact_phone'=>strtolower($contactPhone),
            'contact_email'=>$this->faker->email(),
            'institution'=>$this->faker->word(),
        ];
    }
}
