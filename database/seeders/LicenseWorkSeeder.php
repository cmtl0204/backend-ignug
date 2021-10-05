<?php

namespace Database\Seeders;

use App\Models\Authentication\User;
use App\Models\LicenseWork\Application;
use App\Models\LicenseWork\Employee;
use App\Models\LicenseWork\Employer;
use App\Models\LicenseWork\Form;
use App\Models\LicenseWork\FormState;
use App\Models\LicenseWork\Holiday;
use App\Models\LicenseWork\Reason;
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
        Employer::factory(5)->create();
        State::factory(3)->create();
        User::factory(10)->create();
        Reason::factory(5)->create();
    }
}
