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
        $this->createCategories();
        $this->createCategories();
        $this->createProfessionals();
        $this->createAcademicFormations();
        $this->createLanguages();
        $this->createReferences();
        $this->createSkills();
        $this->createCourses();
        // $this->createExperiences();
        // $this->createOffers();
        // $this->createCompanies();
        // $this->createCategorieOffers();
        // $this->createCompanyProfessionals();
        // $this->createOfferProfessionals();
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


    // public function createProfessionals()
    // {
    //     Professional::factory()
    //         ->hasReferences(3)
    //         ->hasAcademicFormations(3)
    //         ->hasCourses(3)
    //         ->hasExperiences(3)
    //         ->hasLanguages(3)
    //         ->hasSkills(3)
    //         ->create();
    // }

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

    private function createCategorieOffers()
    {
        $offers=Offer::get();
        Category::get()
            ->has($offers);

        // Offer::factory()
        //     ->count(3)
        //     ->hasAttached($categories)
        //     ->create();
    }

    private function createCompanyProfessionals()
    {
        $companies = Company::get();
        Professional::factory()
            ->count(3)
            ->hasAttached($companies)
            ->create();
    }

    private function createOfferProfessionals()
    {
        $offers = Offer::factory()->count(3)->create();
        Professional::factory()
            ->count(3)
            ->hasAttached($offers)
            ->create();
    }
}
