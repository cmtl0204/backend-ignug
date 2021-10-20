<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Student;
use App\Models\Uic\ProjectPlan;
use App\Models\Uic\meshStudent;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Students\IndexStudentRequest;
use App\Http\Requests\V1\Uic\Students\StoreStudentRequest;
use App\Http\Requests\V1\Uic\Students\UpdateStudentRequest;
use App\Http\Requests\V1\Uic\Students\DestroysStudentRequest;

//Resources
use App\Http\Resources\V1\Uic\StudentCollection;
use App\Http\Resources\V1\Uic\StudentResource;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexStudentRequest $request
     * @return StudentCollection
     */
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

    /**
     * Display the specified resource.
     *
     * @param  Student $student
     * @return StudentResource
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest $request
     * @return StudentResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentRequest $request
     * @param  Student $student
     * @return StudentResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student $student
     * @return StudentResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysStudentRequest $request
     * @return StudentCollection
     */
    public function destroys(DestroysStudentRequest $request)
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
