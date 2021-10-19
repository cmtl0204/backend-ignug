<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Planning\DeletePlanningRequest;
use App\Http\Requests\Uic\Planning\IndexPlanningRequest;
use App\Http\Requests\Uic\Planning\StorePlanningRequest;
use App\Http\Requests\Uic\Planning\UpdatePlanningRequest;
use App\Models\Uic\Planning;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Models

// FormRequest en el index store update

class PlanningController extends Controller
{
    public function index(IndexPlanningRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $planning = Planning::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new PlanningCollection($planning))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function store(StorePlanningRequest $request)
    {
        $date = Carbon::now();
        $date = $date->toDateString();

        if ($request->input('planning.end_date') >= $date && $request->input('planning.start_date') >= $date) {
            $planning = new Planning;
            $planning->career_id = $request->input('planning.career.id');
            $planning->name = $request->input('planning.name');
            $planning->start_date = $request->input('planning.start_date');
            $planning->end_date = $request->input('planning.end_date');
            $planning->description = $request->input('planning.description');
            $planning->save();
            
            return (new PlanningResource($planning))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
        }
    }

    public function show(Planning $planning) //cambiar
    {
        return (new PlanningResource($planning))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(UpdatePlanningRequest $request, Planning $planning)
    {
        if (!$planning) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'La convocatoria no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }

        $date = Carbon::now();
        $date = $date->toDateString();

        if ($request->input('planning.end_date') >= $date && $request->input('planning.start_date') >= $date) {
            $planning->career_id = $request->input('planning.career.id');
            $planning->name = $request->input('planning.name');
            $planning->start_date = $request->input('planning.start_date');
            $planning->end_date = $request->input('planning.end_date');
            $planning->description = $request->input('planning.description');
            $planning->save();

            return (new PlanningResource($planning))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
        }
    }
    
    public function destroy(Planning $planning)
    {
        $planning->delete();
        return (new PlanningResource($planning))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysPlanningRequest $request)
    {
        $planning = Planning::whereIn('id', $request->input('ids'))->get();
        Planning::destroy($request->input('ids'));

        return (new PlanningCollection($planning))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
