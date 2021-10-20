<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Student;
use App\Models\Uic\Catalogue;
use App\Models\Uic\StudentInformation;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\StudentsInformation\IndexStudentInformationRequest;
use App\Http\Requests\V1\Uic\StudentsInformation\StoreStudentInformationRequest;
use App\Http\Requests\V1\Uic\StudentsInformation\UpdateStudentInformationRequest;
use App\Http\Requests\V1\Uic\StudentsInformation\DestroysStudentInformationRequest;

//Resources
use App\Http\Resources\V1\Uic\StudentInformationCollection;
use App\Http\Resources\V1\Uic\StudentInformationResource;

class StudentInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexStudentInformationRequest $request
     * @return StudentInformationCollection
     */
    public function index(IndexStudentInformationRequest $request)
    {

        $sorts = explode(',', $request->sort);

        $studentInformations = StudentInformation::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new StudentInformationCollection($studentInformations))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  StudentInformation $studentInformation
     * @return StudentInformationResource
     */
    public function show(StudentInformation $studentInformation)
    {
        return (new StudentInformationResource($studentInformation))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentInformationRequest $request
     * @return StudentInformationResource
     */
    public function store(StoreStudentInformationRequest $request)
    {

        $student = Student::find($request->input('student.id'));
        $relationLaboralCareer = Catalogue::find($request->input('relation_laboral_career.id'));
        $companyArea= Catalogue::find($request->input('company_area.id'));
        $companyPosition = Catalogue::find($request->input('company_position.id'));

        $informationStudent = new StudentInformation;

        $informationStudent->student()->associate($student);
        $informationStudent->relationLaboralCareer()->associate($relationLaboralCareer);
        $informationStudent->companyArea()->associate($companyArea);
        $informationStudent->companyPosition()->associate($companyPosition);

        $informationStudent->company_work = $request->input('company_work');
        $informationStudent->save();
        
        return (new StudentInformationResource($informationStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentInformationRequest $request
     * @param  StudentInformation $informationStudent
     * @return StudentInformationResource
     */
    public function update(UpdateStudentInformationRequest $request,  StudentInformation $informationStudent)
    {
        $student = Student::find($request->input('student.id'));
        $relationLaboralCareer = Catalogue::find($request->input('relation_laboral_career.id'));
        $companyArea= Catalogue::find($request->input('company_area.id'));
        $companyPosition = Catalogue::find($request->input('company_position.id'));

        $informationStudent->student()->associate($student);
        $informationStudent->relationLaboralCareer()->associate($relationLaboralCareer);
        $informationStudent->companyArea()->associate($companyArea);
        $informationStudent->companyPosition()->associate($companyPosition);

        $informationStudent->company_work = $request->input('company_work');
        $informationStudent->save();
        
        return (new StudentInformationResource($informationStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  StudentInformation $informationStudent
     * @return StudentInformationResource
     */
    public function destroy(StudentInformation $informationStudent)
    {
        $informationStudent->delete();
        return (new StudentInformationResource($informationStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysStudentInformationRequest $request
     * @return StudentInformationCollection
     */
    public function destroys(DestroysStudentInformationRequest $request)
    {
        $informationStudent = StudentInformation::whereIn('id', $request->input('ids'))->get();
        StudentInformation::destroy($request->input('ids'));

        return (new StudentInformationCollection($informationStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
