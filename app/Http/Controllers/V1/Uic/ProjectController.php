<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Project\DeleteProjectRequest;
use App\Http\Requests\Uic\Project\IndexProjectRequest;
use App\Http\Requests\Uic\Project\StoreProjectRequest;
use App\Http\Requests\Uic\Project\UpdateProjectRequest;
use App\Models\Uic\Project;
use Illuminate\Http\Request;
use App\Models\Uic\Requirement;
use App\Models\Uic\Enrollment;
use App\Models\Uic\ProjectPlan;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProjectRequest $request)
    {
        if ($request->has('search')) {
            $projects = Project::title($request->input('search'))
                ->description($request->input('search'))->paginate($request->input('per_page'));
        } else {
            $projects = Project::orderBy('id','asc')->get();
        }
        if ($projects->count() == 0) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'No se encontraron proyectos',
                    'detail' => 'Intentalo de nuevo',
                    'code' => '404'
                ]
            ], 404);
        }
        return response()->json($projects, 200);
    }

    public function showById($id){
        $tutors = Tutor::findOrFail($id);
            return response()->json([ $tutors
            ], 200);  
    }

    public function show(Project $project)
    {
        if (!$project) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El proyecto no existe',
                    'detail' => 'Intente con otro proyecto',
                    'code' => '404'
                ]
            ], 404);
        }
        return response()->json([
            'data' => $project
        ], 200);
    }

    public function store(StoreProjectRequest $request)
    {
        $enrollment = Enrollment :: find($request->input('enrollment_id'));
        $projectPlan = ProjectPlan :: find($request->input('project_plan_id'));
        $project = new Project;
        //$project->project_plan_id = $request->input('project.projectPlan.id');
       // $project->enrollment_id = $request->input('project.enrollment.id');
        $project->projectPlan()->associate($projectPlan);
        $project->enrollment()->associate($enrollment);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->score = $request->input('score');
        $project->approved = $request->input('approved');
        $project->total_advance = $request->input('total_advance');
        $project->tutor_asigned = $request->input('tutor_asigned');
        $project->observations = $request->input('observations');
        $project->save();
        return response()->json([
            'data' => $project->fresh(),
            'msg' => [
                'summary' => 'Proyecto creado',
                'detail' => 'El proyecto fue creado con exito',
                'code' => '201'
            ]
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $enrollment = Enrollment :: find($request->input('enrollment_id'));
        $projectPlan = ProjectPlan :: find($request->input('project_plan_id'));        
        $project = Project::find($id);
        if (!$project) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El proyecto no existe',
                    'detail' => 'Intente con otro proyecto',
                    'code' => '404'
                ]
            ], 400);
        }
        $project->projectPlan()->associate($projectPlan);
        $project->enrollment()->associate($enrollment);
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->score = $request->input('score');
        $project->approved = $request->input('approved');
        $project->total_advance = $request->input('total_advance');
        $project->tutor_asigned = $request->input('tutor_asigned');
        $project->observations = $request->input('observations');
        $project->save();
        return response()->json([
            'data' => $project->fresh(),
            'msg' => [
                'summary' => 'Proyecto actualizado',
                'detail' => 'El proyecto fue actualizado',
                'code' => '201'
            ]
        ], 201);
    }

    function delete(DeleteProjectRequest $request)
    {
        Project::destroy($request->input('ids'));

        return response()->json([
            'data' => null,
            'msg' => [
                'summary' => 'Proyectos eliminados',
                'detail' => 'Se eliminó correctamente',
                'code' => '201'
            ]
        ], 201);
    }
}
