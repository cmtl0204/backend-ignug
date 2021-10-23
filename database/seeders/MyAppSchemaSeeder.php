<?php

namespace Database\Seeders;

use App\Models\App\Career;
use App\Models\App\Institution;
use App\Models\App\Mesh;
use App\Models\App\SchoolPeriod;
use App\Models\App\Teacher;
use App\Models\Core\Catalogue;
use App\Models\Uic\Student;
use Illuminate\Database\Seeder;

class MyAppSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTeacherCatalogues();
        $this->createCareerCatalogues();

        $this->createInstitutions();
        $this->createCareers();
        $this->createSchoolPeriods();
        $this->createTeachers();
        $this->createMeshes();
        $this->createStudents();
        $this->createMeshStudent();
    }
    private function createTeacherCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['teaching_ladder']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['dedication_time']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['higher_education']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['country_higher_education']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['scholarship']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['scholarship_type']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['financing_type']['type']
        ]);
    }
    
    
    private function createCareerCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['career']['type']
        ]);
    }
    
    private function createInstitutions()
    {
        Institution::factory(10)->create();
    }
    
    private function createCareers()
    {
        Career::factory(10)->create();
    }
    
    private function createSchoolPeriods()
    {
        SchoolPeriod::factory(10)->create();
    }
    
    private function createTeachers()
    {
        Teacher::factory(10)->create();
    }
    
    private function createMeshes()
    {
        Mesh::factory(10)->create();
    }
    
    private function createStudents()
    {
        Student::factory(10)->create();
    }

    private function createMeshStudent()
    {
        Mesh::factory()
        ->count(10)
        ->hasStudents(5)
        ->create();
    }
}
