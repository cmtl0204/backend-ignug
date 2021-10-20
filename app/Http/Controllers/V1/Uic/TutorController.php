<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Tutor\DeleteTutorRequest;
use App\Http\Requests\Uic\Tutor\IndexTutorRequest;
use App\Http\Requests\Uic\Tutor\StoreTutorRequest;
use App\Http\Requests\Uic\Tutor\UpdateTutorRequest;
use App\Models\App\Catalogue;
use App\Models\Uic\Tutor;
use App\Models\Uic\Teacher;
use Illuminate\Http\Request;
// Models

// FormRequest en el index store update

class TutorController extends Controller
{
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

    public function destroys(DestroysCustomRequest $request)
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
