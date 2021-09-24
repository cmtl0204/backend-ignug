<?php

namespace Database\Factories\JobBoard;

use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Language;
use App\Models\Core\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $professionals = Professional::get();
        $writtenlevels = Catalogue::where('type', 'LANGUAGE_WRITTEN_LEVEL')->get();
        $spokenlevels = Catalogue::where('type', 'LANGUAGE_SPOKEN_LEVEL')->get();
        $readlevels = Catalogue::where('type', 'LANGUAGE_READ_LEVEL')->get();
        $idioms = Catalogue::where('type', 'LANGUAGE_IDIOM')->get();
        return [
            'professional_id'=>$professionals[rand(0, sizeof($professionals) - 1)],
            'idiom_id'=>$idioms[rand(0, sizeof($idioms) - 1)],
            'written_level_id'=>$writtenlevels[rand(0, sizeof($writtenlevels) - 1)],
            'spoken_level_id'=>$spokenlevels[rand(0, sizeof($spokenlevels) - 1)],
            'read_level_id'=>$readlevels[rand(0, sizeof($readlevels) - 1)],
        ];
    }
}
