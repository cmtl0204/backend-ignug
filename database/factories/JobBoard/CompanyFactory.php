<?php

namespace Database\Factories\JobBoard;

use App\Models\Core\Catalogue;
use App\Models\Authentication\User;
use App\Models\JobBoard\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = Catalogue::where('type', 'COMPANY_TYPE')->get();
        $activities = Catalogue::where('type', 'COMPANY_ACTIVITY_TYPE')->get();
        $persons = Catalogue::where('type', 'COMPANY_PERSON_TYPE')->get();
        $users = User::get();
        return [
            'user_id' => $users[rand(0, sizeof($users) - 1)],
            'type_id'=>$types[rand(0, sizeof($types) - 1)],
            'activity_type_id'=>$activities[rand(0, sizeof($activities) - 1)],
            'person_type_id'=>$persons[rand(0, sizeof($persons) - 1)],
            'trade_name'=>$this->faker->text(20),
            'commercial_activities'=>$this->faker->sentences(3),
            'web'=>$this->faker->word(),
        ];
    }
}
