<?php

namespace Database\Seeders;

use App\Models\App\Mesh;
use App\Models\Core\Catalogue;
use App\Models\Uic\Enrollment;
use App\Models\Uic\Event;
use App\Models\Uic\MeshStudentRequirement;
use App\Models\Uic\Modality;
use App\Models\Uic\Planning;
use App\Models\Uic\Project;
use App\Models\Uic\ProjectPlan;
use App\Models\Uic\Requirement;
use App\Models\Uic\RequirementRequest;
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
        $this->createStudentInformationCatalogues();
        $this->createTutorCatalogues();
        $this->createEventCatalogues();
        
        $this->createModalities();
        $this->createPlannings();
        $this->createProjectPlans();
        $this->createStudents();
        $this->createMeshStudent();
        $this->createRequirements();
        $this->createTutors();
        $this->createEnrollments();
        $this->createEvents();
        $this->createMeshStudentRequirements();
        $this->createProjects();
        $this->createRequirementRequests();
        // $this->createStudents();
        $this->createTutorShips();
        $this->createStudentInformations();
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
            'type' => $catalogues['catalogue']['tutor']['type']
        ]);
    }
    
    private function createEventCatalogues()
    {
        $catalogues = json_decode(file_get_contents(storage_path() . "/catalogues.json"), true);
        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['event_name']['type']
        ]);
    }
    private function createEvents()
    {
        Event::factory(10)->create();
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
    
    // private function createStudents()
    // {
    //     Student::factory(10)->create();
    // }
    
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
        RequirementRequest::factory(10)->create();
    }
    
    private function createModalities()
    {
        Modality::factory()
        ->count(10)
        ->hasChildren(5)
        ->create();
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
