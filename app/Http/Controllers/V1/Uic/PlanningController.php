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

        $plannings = Planning::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new PlanningCollection($plannings))
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
        $career = Career::find($request->input('career.id'));
        
        $planning = new Planning();

        $planning->career()->associate($career);
        
        $planning->name = $request->input('name');
        $planning->description = $request->input('description');
        $planning->started_at = $request->input('startedAt');
        $planning->ended_at = $request->input('endedAt');
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
        $career = Career::find($request->input('career.id'));

        $planning->career()->associate($career);
        
        $planning->name = $request->input('name');
        $planning->description = $request->input('description');
        $planning->started_at = $request->input('startedAt');
        $planning->ended_at = $request->input('endedAt');
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
