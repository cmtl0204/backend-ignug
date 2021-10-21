<?php

namespace Database\Factories\Uic;

use App\Models\Uic\Meshes;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeshStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeshStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mesh = Meshes::get();
        
        return [
            'mesh_id' => $mesh[rand(0, sizeof($mesh) - 1)],
            'cohort_started_at' => $this->faker->date(),
            'cohort_ended_at' => $this->faker->date(),
            'graduated' => $this->faker->boolean(3)
        ];
    }
}
