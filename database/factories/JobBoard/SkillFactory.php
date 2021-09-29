<?php

namespace Database\Factories\JobBoard;

use App\Models\Core\Catalogue;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Skill::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $types = Catalogue::where('type', 'SKILL_TYPE')->get();
        return [
            'professional_id'=> $professionals[rand(0, sizeof($professionals) - 1)],
            'type_id'=> $types[rand(0, sizeof($types) - 1)],
            'description'=> $this->faker->text()
        ];
    }
}
