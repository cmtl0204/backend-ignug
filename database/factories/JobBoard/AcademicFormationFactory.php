<?php

namespace Database\Factories\JobBoard;

use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicFormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AcademicFormation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $professionalDegrees = Category::get();
        $certificated = $this->faker->boolean();
        if ($certificated) {
            $registeredAt = $this->faker->date();
            $senescytCode = $this->faker->uuid();
        } else {
            $registeredAt = null;
            $senescytCode = null;
        }

        return [
            'professional_id' => $professionals[rand(0, sizeof($professionals) - 1)],
            'professional_degree_id' => $professionalDegrees[rand(0, sizeof($professionalDegrees) - 1)],
            'registered_at' => $registeredAt,
            'senescyt_code' => $senescytCode,
            'certificated' => $certificated,
        ];
    }
}
