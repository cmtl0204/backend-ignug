<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Requirement;
use App\Models\Uic\Career;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Requirements\IndexRequirementRequest;
use App\Http\Requests\V1\Uic\Requirements\StoreRequirementRequest;
use App\Http\Requests\V1\Uic\Requirements\UpdateRequirementRequest;

//Resources

use App\Http\Resources\V1\Uic\RequirementCollection;
use App\Http\Resources\V1\Uic\RequirementResource;


class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexRequirementRequest $request
     * @return RequirementCollection
     */
    public function index(IndexRequirementRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $requirements = Requirement::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldRequirement'))
            ->paginate($request->input('per_page'));

        return (new RequirementCollection($requirements))
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
     * @param  StoreRequirementRequest $request
     * @return RequirementResource
     */
    public function store(StoreRequirementRequest $request)
    {
        $career = Career::find($request->input('career.id'));

        $requirement = new Requirement;

        $requirement->career()->associate($career);

        $requirement->name = $request->input('name');
        $requirement->required = $request->input('required');
        $requirement->solicited = $request->input('solicited');
        $requirement->save();
        
        return (new RequirementResource($requirement))
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
     * @param  Requirement $requirement
     * @return RequirementResource
     */
    public function show(Requirement $requirement)
    {
        return (new RequirementResource($requirement))
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
     * @param  UpdateRequirementRequest $request
     * @param  Requirement $requirement
     * @return RequirementResource
     */
    public function update(UpdateRequirementRequest $request, Requirement $requirement)
    {
        $career = Career::find($request->input('career.id'));

        $requirement->career()->associate($career);

        $requirement->name = $request->input('name');
        $requirement->required = $request->input('required');
        $requirement->solicited = $request->input('solicited');
        $requirement->save();
        
        return (new RequirementResource($requirement))
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
     * @param  Requirement $requirement
     * @return RequirementResource
     */
    public function destroy(Requirement $requirement)
    {
        $requirement->delete();
        return (new RequirementResource($requirement))
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
     * @param DestroysRequirementRequest $request
     * @return RequirementCollection
     */
    public function destroys(DestroysRequirementRequest $request)
    {
        $requirement = Requirement::whereIn('id', $request->input('ids'))->get();
        Requirement::destroy($request->input('ids'));

        return (new RequirementCollection($requirement))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
