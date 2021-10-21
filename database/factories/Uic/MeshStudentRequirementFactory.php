<?php

namespace Database\Factories\Uic;

use App\Models\Uic\MeshStudentRequirement;
use App\Models\Uic\MeshStudent;
use App\Models\Uic\Requirement;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeshStudentRequirementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeshStudentRequirement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $meshStudent = MeshStudent::get();
        $requirement = Requirement::get();
        
        return [
            'mesh_student_id' => $meshStudent[rand(0, sizeof($meshStudent) - 1)],
            'requirement_id' => $requirement[rand(0, sizeof($requirement) - 1)],
            'approved' => $this->faker->boolean(3),
            'observations' => $this->faker->words()
        ];
    }
}
