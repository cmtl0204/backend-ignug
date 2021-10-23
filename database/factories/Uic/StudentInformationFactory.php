<?php

namespace Database\Factories\Uic;

use App\Models\Uic\StudentInformation;
use App\Models\Core\Catalogue;
use App\Models\Uic\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentInformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentInformation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $students = Student::get();
        $relatioLaboralCareers = Catalogue::where('type', 'relation_laboral_career')->get();
        $companyAreas = Catalogue::where('type', 'company_area')->get();
        $companyPositions = Catalogue::where('type', 'company_position')->get();

        return [
            'student_id' => $students[rand(0, sizeof($students) - 1)],
            'relation_laboral_career_id' => $relatioLaboralCareers[rand(0, sizeof($relatioLaboralCareers) - 1)],
            'company_area_id' => $companyAreas[rand(0, sizeof($companyAreas) - 1)],
            'company_position_id' => $companyPositions[rand(0, sizeof($companyPositions) - 1)],
            'company_work' => $this->faker->word(),
        ];
    }
}
