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
        $requirements = Requirement::get();
        
        return [
            'mesh_student_id' => $this->whenPivotLoaded('mesh_student', function () {
                return $this->pivot->expires_atid;
            }),
            'requirement_id' => $requirements[rand(0, sizeof($requirements) - 1)],
            'approved' => $this->faker->boolean(3),
            'observations' => $this->faker->words()
        ];
    }
}
