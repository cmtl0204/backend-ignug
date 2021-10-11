<?php

namespace Database\Seeders;

use App\Models\Core\Catalogue;
use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Experience;
use App\Models\JobBoard\Language;
use App\Models\JobBoard\Reference;
use App\Models\JobBoard\Skill;
use App\Models\JobBoard\Course;
use App\Models\JobBoard\Company;
use App\Models\JobBoard\Offer;
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
        $this->createCourseCatalogues();
        // $this->createCategories();
        $this->createAreas();
        $this->createProfessionals();
        $this->createAcademicFormations();
        $this->createLanguages();
        $this->createReferences();
        $this->createSkills();
        $this->createCourses();
        $this->createExperiences();
        $this->createCompanies();
        // $this->createOffers();
        $this->createCategoryOffers();
        $this->createCompanyProfessionals();
        $this->createOfferProfessionals();
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

        Catalogue::factory()->count(10)->create([
            'type' => $catalogues['catalogue']['experience_area']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['skill_type']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['language_idiom']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['language_written_level']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['language_spoken_level']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['language_read_level']['type']
        ]);

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['company_type']['type']
        ]);

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['company_activity_type']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['company_person_type']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['offer_contract_type']['type']
        ]);

        Catalogue::factory()->count(3)->create([
            'type' => $catalogues['catalogue']['offer_sector']['type']
        ]);

        Catalogue::factory()->count(5)->create([
            'type' => $catalogues['catalogue']['offer_working_day']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['offer_training_hours']['type']
        ]);

        Catalogue::factory()->count(2)->create([
            'type' => $catalogues['catalogue']['offer_experience_time']['type']
        ]);
    }

    private function createCategories()
    {
        Category::factory(10)->create();
    }

    private function createAreas()
    {
        Category::factory()
        ->count(10)
        ->hasChildren(5)
        ->create();
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

    private function createExperiences()
    {
        Experience::factory(10)->create();
    }

    private function createCompanies()
    {
        Company::factory(10)->create();
    }

    private function createCourses()
    {
        Course::factory(10)->create();
    }

    private function createLanguages()
    {
        Language::factory(10)->create();
    }

    private function createReferences()
    {
        Reference::factory(10)->create();
    }

    private function createSkills()
    {
        Skill::factory(10)->create();
    }

    private function createOffers()
    {
        Offer::factory(10)->create();
    }

    private function createCategoryOffers()
    {
        Offer::factory()
        ->count(10)
        ->hasCategories(5)
        ->create();
    }

    private function createCompanyProfessionals()
    {
        Professional::factory(5)
            ->has(Company::factory()->count(3))
            ->create();
    }

    private function createOfferProfessionals()
    {
        Professional::factory(5)
            ->has(Offer::factory()->count(3))
            ->create();
    }
}
