<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Tutor;
use App\Models\Uic\Teacher;
use App\Models\Uic\ProjectPlan;
use App\Models\App\Catalogue;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Tutors\IndexTutorRequest;
use App\Http\Requests\V1\Uic\Tutors\DestroysTutorRequest;
use App\Http\Requests\V1\Uic\Tutors\UpdateTutorRequest;
use Illuminate\Http\Request;

//Resources
use App\Http\Resources\V1\Uic\TutorCollection;
use App\Http\Resources\V1\Uic\TutorResource;

class TutorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexTutorRequest $request
     * @return TutorCollection
     */
    public function index(IndexTutorRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $tutors = Tutor::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new TutorCollection($tutors))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(Tutor $tutor)
    {
        return (new TutorResource($tutor))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request $request
     * @return TutorResource
     */
    public function store(Request $request)
    {
        $projectPlan = ProjectPlan::find($request->input('project_plan.id'));
        $teacher = Teacher::find($request->input('teacher.id'));
        $type = Catalogue::find($request->input('type.id'));

        $tutor = new Tutor();

        $tutor->projectPlan()->associate($projectPlan);
        $tutor->teacher()->associate($teacher);
        $tutor->type()->associate($type);
        
        $tutor->observations = $request->input('observations');
        $tutor->save();
        
        return (new TutorResource($tutor))
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
     * @param  UpdateTutorRequest $request
     * @param  Tutor $tutor
     * @return TutorResource
     */
    public function update(UpdateTutorRequest $request,  Tutor $tutor)
    {
        $projectPlan = ProjectPlan::find($request->input('project_plan.id'));
        $teacher = Teacher::find($request->input('teacher.id'));
        $type = Catalogue::find($request->input('type.id'));

        $tutor->projectPlan()->associate($projectPlan);
        $tutor->teacher()->associate($teacher);
        $tutor->type()->associate($type);
        
        $tutor->observations = $request->input('observations');
        $tutor->save();
        
        return (new TutorResource($tutor))
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
     * @param  Tutor $tutor
     * @return TutorResource
     */
    public function destroy(Tutor $tutor)
    {
        $tutor->delete();
        return (new TutorResource($tutor))
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
     * @param DestroysTutorRequest $request
     * @return TutorCollection
     */
    public function destroys(DestroysTutorRequest $request)
    {
        $tutor = Tutor::whereIn('id', $request->input('ids'))->get();
        Tutor::destroy($request->input('ids'));

        return (new TutorCollection($tutor))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
