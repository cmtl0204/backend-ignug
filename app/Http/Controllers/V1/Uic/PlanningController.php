<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Planning;
use App\Models\Uic\Career;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Plannings\DeletePlanningRequest;
use App\Http\Requests\V1\Uic\Plannings\IndexPlanningRequest;
use App\Http\Requests\V1\Uic\Plannings\StorePlanningRequest;
use App\Http\Requests\V1\Uic\Plannings\UpdatePlanningRequest;

//Resources
use App\Http\Resources\V1\Uic\PlanningCollection;
use App\Http\Resources\V1\Uic\PlanningResource;

class PlanningController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexPlanningRequest $request
     * @return PlanningCollection
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePlanningRequest $request
     * @return PlanningResource
     */
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

    /**
     * Display the specified resource.
     *
     * @param  Planning $planning
     * @return PlanningResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePlanningRequest $request
     * @param  Planning $planning
     * @return PlanningResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Planning $planning
     * @return PlanningResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysPlanningRequest $request
     * @return PlanningCollection
     */
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
