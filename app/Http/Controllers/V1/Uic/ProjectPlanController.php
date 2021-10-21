<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Student;
use App\Models\Uic\Tutor;
use App\Models\Uic\Requirement;
use App\Models\App\Teacher;
use App\Models\Uic\ProjectPlan;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Controllers\App\FileController;
use App\Http\Requests\V1\Uic\ProjectPlans\IndexProjectPlanRequest;
use App\Http\Requests\V1\Uic\ProjectPlans\StoreProjectPlanRequest;
use App\Http\Requests\V1\Uic\ProjectPlans\UpdateProjectPlanRequest;
use App\Http\Requests\V1\Uic\ProjectPlans\DestroysProjectPlanRequest;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use Illuminate\Http\Request;

//Resources
use App\Http\Resources\V1\Uic\ProjectPlanCollection;
use App\Http\Resources\V1\Uic\ProjectPlanResource;

class ProjectPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexProjectPlanRequest $request
     * @return ProjectPlanCollection
     */
    public function index(IndexProjectPlanRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $projectPlans = ProjectPlan::customSelect($request->fields)->customOrderBy($sorts)
            ->title($request->input('title'))
            ->description($request->input('description'))
            ->actCode($request->input('act_code'))
            ->paginate($request->input('per_page'));

        return (new ProjectPlanCollection($projectPlans))
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectPlanRequest $request
     * @return ProjectPlanResource
     */
    public function store(StoreProjectPlanRequest $request)
    {

        $projectPlan = new ProjectPlan;

        $projectPlan->title = $request->input('title');
        $projectPlan->description = $request->input('description');
        $projectPlan->act_code = $request->input('act_code');
        $projectPlan->approved_at = $request->input('approvedAt');
        $projectPlan->approved = $request->input('approved');
        $projectPlan->observations = $request->input('observations');
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

    /**
     * Display the specified resource.
     *
     * @param  ProjectPlan $projectPlan
     * @return ProjectPlanResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectPlanRequest $request
     * @param  ProjectPlan $projectPlan
     * @return ProjectPlanResource
     */
    public function update(UpdateProjectPlanRequest $request, ProjectPlan $projectPlan)
    {
        $projectPlan->title = $request->input('title');
        $projectPlan->description = $request->input('description');
        $projectPlan->act_code = $request->input('act_code');
        $projectPlan->approved_at = $request->input('approvedAt');
        $projectPlan->approved = $request->input('approved');
        $projectPlan->observations = $request->input('observations');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProjectPlan $projectPlan
     * @return ProjectPlanResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysProjectPlanRequest $request
     * @return ProjectPlanCollection
     */
    public function destroys(DestroysProjectPlanRequest $request)
    {
        $projectPlan = ProjectPlan::whereIn('id', $request->input('ids'))->get();
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
