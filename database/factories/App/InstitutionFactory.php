<?php

namespace Database\Factories\App;

use App\Models\App\Institution;
use App\Models\Core\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Institution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $addresses = Address::get();
        
        return [
            'address_id' => $addresses[rand(0, sizeof($addresses) - 1)],
            'code' => $this->faker->uuid(),
            'denomination' => $this->faker->word(),
            'name' => $this->faker->word(),
            'short_name' => $this->faker->word(),
            'acronym' => $this->faker->word(),
            'email' => $this->faker->email(),
            'slogan' => $this->faker->text(30),
            'logo' => $this->faker->word(),
            'web' => $this->faker->word(),
            'codigo_sniese' => $this->faker->word(),
        ];
    }
}