<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\StudentInformation\DeleteStudentInformationRequest;
use App\Http\Requests\Uic\StudentInformation\IndexStudentInformationRequest;
use App\Http\Requests\Uic\StudentInformation\StoreStudentInformationRequest;
use App\Http\Requests\Uic\StudentInformation\UpdateStudentInformationRequest;
use App\Models\Uic\Student;
use App\Models\Uic\StudentInformation;

// Models

// FormRequest en el index store update

class StudentInformationController extends Controller
{
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

    public function show($id)
    {
        return (new StudentInformationResource($example))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

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

    public function destroys(DestroysCustomRequest $request)
    {
        $informationStudent = StudentInformation::whereIn('id', $request->input('ids'))->get();
        StudentInformation::destroy($request->input('ids'));

        return (new StudentInformatiomCollection($informationStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
