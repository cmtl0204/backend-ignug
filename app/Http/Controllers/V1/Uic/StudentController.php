<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Student\IndexStudentRequest;
use App\Http\Requests\Uic\Student\StoreStudentRequest;
use App\Http\Requests\Uic\Student\UpdateStudentRequest;
use App\Models\Uic\Student;

// Models

// FormRequest en el index store update

class StudentController extends Controller
{
    public function index(IndexStudentRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $students = Student::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new StudentCollection($students))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(Student $student) //cambiar
    {
        return (new StudentResource($student))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $projectPlan = ProjectPlan::find($request->input('project_plan.id'));
        $meshStudent = meshStudent::find($request->input('mesh_student.id'));

        $student = new Student;

        $student->projectPlan()->associate($projectPlan);
        $student->meshStudent()->associate($meshStudent);

        $student->observations = $request->input('observations');
        $student->save();
        
        return (new StudentResource($student))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $projectPlan = ProjectPlan::find($request->input('project_plan.id'));
        $meshStudent = meshStudent::find($request->input('mesh_student.id'));

        $student->projectPlan()->associate($projectPlan);
        $student->meshStudent()->associate($meshStudent);

        $student->observations = $request->input('observations');
        $student->save();
        
        return (new StudentResource($student))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return (new StudentResource($student))
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
        $student = Student::whereIn('id', $request->input('ids'))->get();
        Student::destroy($request->input('ids'));

        return (new StudentCollection($student))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
