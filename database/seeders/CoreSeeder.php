<?php

namespace Database\Seeders;

use App\Models\Authentication\System;
use App\Models\Core\Career;
use App\Models\Core\Catalogue;
use App\Models\Core\Email;
use App\Models\Core\Institution;
use App\Models\Core\Location;
use App\Models\Authentication\Menu;
use App\Models\Core\Phone;
use App\Models\Authentication\User;
use App\Models\Core\State;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createInstitutions();
        $this->createCareers();
    }

    private function createInstitutions()
    {
        Institution::factory(3)->sequence(
            [
                'code' => 'ABC1',
                'name' => 'INSTITUTO SUPERIOR TECNOLOGICO YAVIRAC',
                'short_name' => 'YAVIRAC',
                'acronym' => 'ISTY'
            ],
            [
                'code' => 'ABC2',
                'name' => 'INSTITUTO SUPERIOR TECNOLOGICO BENITO JUAREZ',
                'short_name' => 'BENITO JUAREZ',
                'acronym' => 'ISTBJ'
            ],
            [
                'code' => 'ABC3',
                'name' => 'INSTITUTO SUPERIOR TECNOLOGICO GRAN COLOMBIA',
                'short_name' => 'GRAN COLOMBIA',
                'acronym' => 'ISTGC'
            ],
        )->create();
    }

    private function createCareers()
    {
        Career::factory(4)->sequence(
            ['name' => 'DESARROLLO DE SOFTWARE'],
            ['name' => 'MARKETING'],
            ['name' => 'DISEÑO DE MODAS'],
            ['name' => 'ARTE CULINARIO'],
        )->create();
    }
}
