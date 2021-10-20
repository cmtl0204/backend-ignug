<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Tutor\DeleteTutorRequest;
use App\Http\Requests\Uic\Tutor\IndexTutorRequest;
use App\Http\Requests\Uic\Tutor\StoreTutorRequest;
use App\Http\Requests\Uic\Tutor\UpdateTutorRequest;
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
        $tutor = new Tutor();
        $tutor->project_plan_id = $request->input('project_plan_id');
        $tutor->teacher_id = $request->input('teacher_id');
        $tutor->type_id = $request->input('type_id');
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

    public function update(UpdateTutorRequest $request, $id)
    {
        $tutor = Tutor::find($id);
        if (!$tutor) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El tutor no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }
        $tutor->project_plan_id = $request->input('tutor.project_plan.id');
        $tutor->teacher_id = $request->input('tutor.teacher.id');
        $tutor->type_id = $request->input('tutor.type.id');
        $tutor->observations = $request->input('tutor.observations');
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
