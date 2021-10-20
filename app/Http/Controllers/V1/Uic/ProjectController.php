<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Requirement;
use App\Models\Uic\Enrollment;
use App\Models\Uic\ProjectPlan;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Projects\IndexProjectRequest;
use App\Http\Requests\V1\Uic\Projects\StoreProjectRequest;
use App\Http\Requests\V1\Uic\Projects\UpdateProjectRequest;
use App\Models\Uic\Project;
use Illuminate\Http\Request;

//Resources
use App\Http\Resources\V1\Uic\ProjectCollection;
use App\Http\Resources\V1\Uic\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexProjectRequest $request
     * @return ProjectCollection
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectRequest $request
     * @return ProjectResource
     */
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

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return ProjectResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Project $project
     * @return ProjectResource
     */
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return ProjectResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysProjectRequest $request
     * @return ProjectCollection
     */
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
