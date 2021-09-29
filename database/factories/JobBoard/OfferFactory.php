<?php

namespace Database\Factories\JobBoard;

use App\Models\Core\Catalogue;
use App\Models\Core\Location;
use App\Models\Core\State;
use App\Models\JobBoard\Company;
use App\Models\JobBoard\Offer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companies = Company::get();
        $locations = Location::get();
        $contracts = Catalogue::where('type', 'OFFER_CONTRACT_TYPE')->get();
        $sectors = Catalogue::where('type', 'OFFER_SECTOR')->get();
        $workingDays = Catalogue::where('type', 'OFFER_WORKING_DAY')->get();
        $trainingHours = Catalogue::where('type', 'OFFER_TRAINING_HOURS')->get();
        $times = Catalogue::where('type', 'OFFER_EXPERIENCE_TIME')->get();
        $states = State::get();

        return [
            'company_id' => $companies[rand(0, sizeof($companies) - 1)],
            'location_id' => $locations[rand(0, sizeof($locations) - 1)],
            'contract_type_id' => $contracts[rand(0, sizeof($contracts) - 1)],
            'sector_id' => $sectors[rand(0, sizeof($sectors) - 1)],
            'working_day_id' => $workingDays[rand(0, sizeof($workingDays) - 1)],
            'training_hours_id' => $trainingHours[rand(0, sizeof($trainingHours) - 1)],
            'state_id' => $states[rand(0, sizeof($states) - 1)],
            'experience_time_id' => $times[rand(0, sizeof($times) - 1)],
            'code' => $this->faker->uuid(),
            'position' => $this->faker->word(),
            'contact_name' => $this->faker->word(),
            'contact_email' => $this->faker->word(),
            'contact_phone' => $this->faker->word(),
            'contact_cellphone' => $this->faker->word(),
            'remuneration' => $this->faker->word(),
            'vacancies' => $this->faker->randomDigit(),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date(),
            'activities' => $this->faker->sentences(5),
            'requirements' => $this->faker->sentences(5),
            'additional_information' => $this->faker->text(30),
        ];
    }
}
