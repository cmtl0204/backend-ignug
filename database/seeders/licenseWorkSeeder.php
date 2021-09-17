<?php

namespace Database\Seeders;

use App\Models\Core\Catalogue;
use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;
use Illuminate\Database\Seeder;

class licenseWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCourseCatalogues();
        $this->createCategories();
        $this->createCategories();
        $this->createProfessionals();
        $this->createAcademicFormations();
    }

    private function createCourseCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['course_event_type']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['course_certification_type']['type']
        ]);

        Catalogue::factory()->count(20)->create([
            'type' => $catalogues['catalogue']['course_area']['type']
        ]);
    }
    private function createCategories()
    {
        Category::factory(20)->create();
    }

    private function createProfessionals()
    {
        Professional::factory()->create(['user_id' => 1]);
        Professional::factory(10)->create();
    }

    private function createAcademicFormations()
    {
        AcademicFormation::factory(10)->create();
    }

}
