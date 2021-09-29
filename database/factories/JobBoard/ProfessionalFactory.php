<?php

namespace Database\Factories\JobBoard;

use App\Models\Authentication\User;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfessionalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Professional::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::get();
        return [
            'user_id' => $users[rand(0, sizeof($users) - 1)]
        ];
    }
}
