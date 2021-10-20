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
        $sorts = explode(',', $request->sort);

        $projects = Project::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new ProjectCollection($projects))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function showById($id){
        $tutors = Tutor::findOrFail($id);
            return response()->json([ $tutors
            ], 200);  
    }

    public function store(StoreProjectRequest $request)
    {
        $enrollment = Enrollment :: find($request->input('enrollment.id'));
        $projectPlan = ProjectPlan :: find($request->input('project_plan.id'));

        $project = new Project;
        
        $project->projectPlan()->associate($projectPlan);
        $project->enrollment()->associate($enrollment);

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->tutor_asigned = $request->input('tutorAsigned');
        $project->total_advance = $request->input('totalAdvance');
        $project->score = $request->input('score');
        $project->approved = $request->input('approved');
        $project->observations = $request->input('observations');
        $project->save();
        
        return (new ProjectResource($project))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(Project $project)
    {
        return (new ProjectResource($project))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(Request $request, Project $project)
    {
        $enrollment = Enrollment :: find($request->input('enrollment.id'));
        $projectPlan = ProjectPlan :: find($request->input('project_plan.id'));

        $project = new Project;
        
        $project->projectPlan()->associate($projectPlan);
        $project->enrollment()->associate($enrollment);

        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->tutor_asigned = $request->input('tutorAsigned');
        $project->total_advance = $request->input('totalAdvance');
        $project->score = $request->input('score');
        $project->approved = $request->input('approved');
        $project->observations = $request->input('observations');
        $project->save();
        
        return (new ProjectResource($project))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return (new ProjectResource($project))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysProjectRequest $request)
    {
        $project = Project::whereIn('id', $request->input('ids'))->get();
        Project::destroy($request->input('ids'));

        return (new ProjectCollection($project))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
