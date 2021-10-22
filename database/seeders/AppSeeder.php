<?php

namespace Database\Seeders;
namespace App\Models\Uic;

use App\Models\Core\Catalogue;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createStudentInformationCatalogues();
        $this->createTutorCatalogues();
        $this->createEventCatalogues();
        
        $this->createMeshStudents();
        $this->createModalities();
        $this->createPlannings();
        $this->createProjectPlans();
        $this->createRequirements();
        $this->createTutors();
        $this->createEnrollments();
        $this->createEvents();
        $this->createMeshStudentRequirements();
        $this->createRequirementRequests();
        $this->createStudents();
        $this->createTutorShips();
        $this->createProjects();
        $this->createStudentInformations();
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

    private function createEnrollments()
    {
        Enrollment::factory(10)->create();
    }

    private function createRequirementRequests()
    {
        RequimentRequest::factory(10)->create();
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
