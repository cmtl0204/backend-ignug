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

        $examples = StudentInformation::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new StudentInformationCollection($examples))
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
        $informationStudent = new StudentInformation;
        $informationStudent->student_id = $request->input('studentInformation.student.id');
        $informationStudent->company_work = $request->input('studentInformation.company_work');
        $informationStudent->relation_laboral_career_id = $request->input('studentInformation.relation_laboral_career.id');
        $informationStudent->company_area_id = $request->input('studentInformation.company_area.id');
        $informationStudent->company_position_id = $request->input('studentInformation.company_position.id');
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

    public function update(UpdateStudentInformationRequest $request, $id)
    {
        $informationStudent = StudentInformation::find($id);
        if (!$informationStudent) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'La información no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }
        $informationStudent->student_id = $request->input('studentInformation.student.id');
        $informationStudent->company_work = $request->input('studentInformation.company_work');
        $informationStudent->relation_laboral_career_id = $request->input('studentInformation.relation_laboral_career.id');
        $informationStudent->company_area_id = $request->input('studentInformation.company_area.id');
        $informationStudent->company_position_id = $request->input('studentInformation.company_position.id');
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
