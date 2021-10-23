<?php

namespace Database\Factories\App;

use App\Models\App\Institution;
use App\Models\App\Teacher;
use App\Models\Core\Catalogue;
use App\Models\Uic\Modality;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $institutions = Institution::get();
        $modalities = Modality::get();
        $types = Catalogue::where('type', 'EVENT_NAME')->get();
        
        return [
            'institution_id' => $institutions[rand(0, sizeof($institutions) - 1)],
            'modality_id' => $modalities[rand(0, sizeof($modalities) - 1)],
            'type_id' => $types[rand(0, sizeof($types) - 1)],
            'code' => $this->faker->uuid(),
            'name' => $this->faker->word(),
            'description' => $this->faker->text(30),
            'short_name' => $this->faker->word(),
            'resolution_number' => $this->faker->word(),
            'title' => $this->faker->word(),
            'acronym' => $this->faker->word(),
            'logo' => $this->faker->word(),
            'learning_results' => $this->faker->words(3),
            'codigo_sniese' => $this->faker->word(),
        ];
    }
}