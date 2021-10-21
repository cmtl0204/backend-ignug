<?php

namespace Database\Seeders;

use App\Models\Core\Catalogue;
use App\Models\Uic\Enrollment;
use App\Models\Uic\MeshStudent;
use App\Models\Uic\MeshStudentRequirement;
use App\Models\Uic\Modality;
use App\Models\Uic\Planning;
use App\Models\Uic\Project;
use App\Models\Uic\ProjectPlan;
use App\Models\Uic\Requirement;
use App\Models\Uic\Student;
use App\Models\Uic\StudentInformation;
use App\Models\Uic\Tutor;
use App\Models\Uic\TutorShip;
use Illuminate\Database\Seeder;

class UicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTeacherCatalogues();
        $this->createStudentInformationCatalogues();
        $this->createTutorCatalogues();
        $this->createEventCatalogues();
        $this->createEvents();
        $this->createMeshStudents();
        $this->createMeshStudentRequirements();
        $this->createPlannings();
        $this->createProjects();
        $this->createProjectPlans();
        $this->createRequirements();
        $this->createStudents();
        $this->createStudentInformations();
        $this->createTutors();
        $this->createTutorShips();
        $this->createModalities();
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

    private function createStudentInformationCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['relation_laboral_career']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['company_area']['type']
        ]);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['company_position']['type']
        ]);
    }
    
    private function createTutorCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['type']['type']
        ]);
    }
    
    private function createEventCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['name']['type']
        ]);
    }
    private function createEvents()
    {
        Enrollment::factory(10)->create();
    }
    
    private function createMeshStudents()
    {
        MeshStudent::factory(10)->create();
    }
    
    private function createMeshStudentRequirements()
    {
        MeshStudentRequirement::factory(10)->create();
    }
    
    private function createPlannings()
    {
        Planning::factory(10)->create();
    }
    
    private function createProjects()
    {
        Project::factory(10)->create();
    }
    
    private function createProjectPlans()
    {
        ProjectPlan::factory(10)->create();
    }
    
    private function createRequirements()
    {
        Requirement::factory(10)->create();
    }
    
    private function createStudents()
    {
        Student::factory(10)->create();
    }
    
    private function createStudentInformations()
    {
        StudentInformation::factory(10)->create();
    }
    
    private function createTutors()
    {
        Tutor::factory(10)->create();
    }
    
    private function createTutorShips()
    {
        TutorShip::factory(10)->create();
    }
    
    private function createModalities()
    {
        Modality::factory()
        ->count(10)
        ->hasChildren(5)
        ->create();
    }

    // private function createProfessionals()
    // {
    //     Professional::factory()->create(['user_id' => 1]);
    //     Professional::factory(10)->create();
    // }


    // private function createCategoryOffers()
    // {
    //     Offer::factory()
    //     ->count(10)
    //     ->hasCategories(5)
    //     ->create();
    // }

    // private function createCompanyProfessionals()
    // {
    //     Professional::factory(5)
    //         ->has(Company::factory()->count(3))
    //         ->create();
    // }

}
