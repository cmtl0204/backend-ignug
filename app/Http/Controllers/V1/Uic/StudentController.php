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

        $student = Student::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new StudentCollection($student))
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
        $student = new Student;
        $student->project_plan_id = $request->input('student.project_plan.id');
        $student->mesh_student_id = $request->input('student.mesh_student.id');
        $student->observations = $request->input('student.observations');
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
        if (!$student) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El estudiante no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }
        $student->project_plan_id = $request->input('student.project_plan.id');
        $student->mesh_student_id = $request->input('student.mesh_student.id');
        $student->observations = $request->input('student.observations');
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

    public function destroy(Example $example)
    {
        $example->delete();
        return (new ExampleResource($example))
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
        $examples = Example::whereIn('id', $request->input('ids'))->get();
        Example::destroy($request->input('ids'));

        return (new ExampleCollection($examples))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
