<?php

namespace Database\Seeders;

use App\Models\LicenseWork\Application;
use App\Models\LicenseWork\Employee;
use App\Models\LicenseWork\Employer;
use App\Models\LicenseWork\Form;
use App\Models\LicenseWork\FormState;
use App\Models\LicenseWork\Holiday;
use App\Models\LicenseWork\State;
use Illuminate\Database\Seeder;

class LicenseWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::factory()
            ->has(Application::factory()->count(1),'applications')
            ->has(Holiday::factory()->count(1),'holidays')
                ->create();
        Employer::factory()
            ->has(Form::factory()->count(1),'forms')
                ->create();
        Form::factory()
            ->has(FormState::factory()->count(1),'formStates')
                ->create();
        State::factory()
            ->has(State::factory()->count(1),'formStates')
                ->create();
    }
}
