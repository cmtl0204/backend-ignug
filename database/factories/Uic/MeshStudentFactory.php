<?php

namespace Database\Factories\Uic;

use App\Models\App\Mesh;
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
        $meshes = Mesh::get();
        
        return [
            // 'mesh_id' => $meshes[rand(0, sizeof($meshes) - 1)],
            // 'cohort_started_at' => $this->faker->date(),
            // 'cohort_ended_at' => $this->faker->date(),
            // 'graduated' => $this->faker->boolean(3)
        ];
    }
}
