<?php

namespace Database\Seeders;

use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Seeder;

class JobBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategories();
        $this->createProfessionals();
        $this->createAcademicFormations();
    }

    private function createCategories()
    {
        Category::factory(20)->create();
    }

    private function createProfessionals()
    {
        Professional::factory(10)->create();
    }

    private function createAcademicFormations()
    {
        AcademicFormation::factory(10)->create();
    }

}
