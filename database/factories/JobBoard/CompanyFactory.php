<?php

namespace Database\Factories\JobBoard;

use App\Models\Model;
use App\Models\Core\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
        $users = User::get();
        return [
            'user_id' => $users[rand(0, sizeof($users) - 1)],
            'type_id'=>'',
            'activity_type_id'=>'',
            'person_type_id'=>'',
            'trade_name'=>$this->faker->text(20),
            'commercial_activities'=>$this->faker->sentences(3),
            'web'=>$this->faker->word(),
        ];
    }
}
