<?php

namespace Database\Seeders;

use App\Models\Authentication\User;
use App\Models\LicenseWork\Dependence;
use App\Models\LicenseWork\Employer;
use App\Models\LicenseWork\Reason;
use App\Models\LicenseWork\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class LicenseWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::factory(10)->create();

        State::factory(3)->create()->state(new Sequence([
            'name'=>'SAVED',
            'code'=>'001'
        ],[
            'name'=>'PRE-APPROVED',
            'code'=>'002'
        ],[
            'name'=>'APPROVED',
            'code'=>'003'
        ],[
            'name'=>'NO-APPROVED',
            'code'=>'004'
        ],));

        User::factory(10)->create();

        Reason::factory(10)->create();

        Dependence::factory(3)->create()->state(new Sequence([
            'name'=>'COORDINATION',
            'level'=>1,
            ],[
            'name'=>'ADMINISTRATION',
            'level'=>2,
            ],[
            'name'=>'RECTORATE ',
            'code'=>'003'
        ],
        ));
    }
}
