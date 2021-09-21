<?php

namespace Database\Factories\JobBoard;

use App\Models\Model;
use App\Models\JobBoard\Professional;
use App\Models\Core\Catalogue;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
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
        $professionals = Catalogue::get();
        $professionals = Catalogue::get();
        $professionals = Catalogue::get();
        $professionals = Catalogue::get();
        return [
            'professional_id'=>$professionals[rand(0, sizeof($professionals) - 1)],
            'idiom_id'=>'',
            'written_level_id'=>'',
            'spoken_level_id'=>'',
            'read_level_id'=>'',
        ];
    }
}
