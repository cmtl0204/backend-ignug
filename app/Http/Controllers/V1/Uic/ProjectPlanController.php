<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\ProjectPlan\DeleteProjectPlanRequest;
use App\Http\Requests\Uic\ProjectPlan\IndexProjectPlanRequest;
use App\Http\Requests\Uic\ProjectPlan\StoreProjectPlanRequest;
use App\Http\Requests\Uic\ProjectPlan\UpdateProjectPlanRequest;
use App\Models\Uic\ProjectPlan;
use Illuminate\Http\Request;
use App\Models\Uic\Requirement;
use App\Models\App\Teacher;
use App\Http\Controllers\App\FileController;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Models\Uic\Student;
use App\Models\Uic\Tutor;

class ProjectPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProjectPlanRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $projectPlan = ProjectPlan::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new ProjectPlanCollection($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function getTeachers(Request $request)
    {
        $teachers = Teacher::with('user')->get();
        if ($teachers->count() === 0) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'No se encontraron docentes',
                    'detail' => 'Intentelo de nuevo',
                    'code' => '404'
                ]
            ], 404);
        }
        return response()->json(
            [
                'data' => $teachers,
                'msg' => [
                    'summary' => 'Success',
                    'detail' => 'Success',
                    'code' => '200'
                ]
            ],
            200
        );
    }

    public function show(ProjectPlan $projectPlan)
    {
        return (new ProjectPlanResource($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function store(StoreProjectPlanRequest $request)
    {

        $projectPlan = new ProjectPlan;
        $projectPlan->title = $request->input('projectPlan.title');
        $projectPlan->description = $request->input('projectPlan.description');
        $projectPlan->act_code = $request->input('projectPlan.act_code');
        $projectPlan->approval_date = $request->input('projectPlan.approval_date');
        $projectPlan->is_approved = $request->input('projectPlan.is_approved');
        $projectPlan->observations = $request->input('projectPlan.observations');
        $projectPlan->save();

        $students = $request->input('projectPlan.students');
        for ($i = 0; $i < count($students); $i++) {
            $id = $students[$i]['id'];
            $student = Student::findOrFail($id);
            $student->project_plan_id = $projectPlan->id;
            $student->save();
        }

        $teachers = $request->input('projectPlan.teachers');
        for ($i = 0; $i < count($teachers); $i++) {
            $tutor = Tutor::where('teacher_id', '=', $teachers[$i]['id'])->where('project_plan_id', '=', $projectPlan->id)->first();
            if (!$tutor) {
                // $tutor = new Tutor();
                // $tutor->type_id = 1;
                // $tutor->projectPlan()->associate($projectPlan);
                // $tutor->teacher()->associate($teachers[$i]);
                // $tutor->save();

                $tutor = new Tutor();
                $id = $teachers[$i]['id'];
                $tutor->type_id = 1;
                $tutor->project_plan_id = $projectPlan->id;
                $tutor->teacher_id = $id;
                $tutor->save();
            }
        }
        return (new ProjectPlanResource($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function update(UpdateProjectPlanRequest $request, $id)
    {
        $projectPlan = ProjectPlan::find($id);
        if (!$projectPlan) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El acta de aprobación del anteproyecto no existe',
                    'detail' => 'Intente con otro acta',
                    'code' => '404'
                ]
            ], 400);
        }
        $projectPlan->title = $request->input('projectPlan.title');
        $projectPlan->description = $request->input('projectPlan.description');
        $projectPlan->act_code = $request->input('projectPlan.act_code');
        $projectPlan->approval_date = $request->input('projectPlan.approval_date');
        $projectPlan->is_approved = $request->input('projectPlan.is_approved');
        $projectPlan->observations = $request->input('projectPlan.observations');
        $projectPlan->save();
       
        return (new ProjectPlanResource($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(ProjectPlan $projectPlan)
    {
        $projectPlan->delete();
        return (new ProjectPlanResource($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysProjectPlanRequest $request)
    {
        $projectPlan = EProjectPlan::whereIn('id', $request->input('ids'))->get();
        ProjectPlan::destroy($request->input('ids'));

        return (new ProjectPlanCollection($projectPlan))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }


    function uploadFile(UploadFileRequest $request)
    {
        return (new FileController())->upload($request, ProjectPlan::getInstance($request->input('id')));
    }

    public function updateFile(UpdateFileRequest $request)
    {
        return (new FileController())->update($request, ProjectPlan::getInstance($request->input('id')));
    }

    function deleteFile($fileId)
    {
        return (new FileController())->delete($fileId);
    }

    function indexFile(IndexFileRequest $request)
    {
        return (new FileController())->index($request, ProjectPlan::getInstance($request->input('id')));
    }

    function ShowFile($fileId)
    {
        return (new FileController())->show($fileId);
    }
}
