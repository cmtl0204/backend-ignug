<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\RequirementRequest;
use App\Models\Uic\Requirement;
use App\Models\Uic\meshStudent;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\RequirementsRequest\IndexRequirementRequestRequest;
use App\Http\Requests\V1\Uic\RequirementsRequest\StoreRequirementRequestRequest;
use App\Http\Requests\V1\Uic\RequirementsRequest\UpdateRequirementRequestRequest;
use App\Http\Requests\V1\Uic\RequirementsRequest\DestroysRequirementRequestRequest;

//Resources
use App\Http\Resources\V1\Uic\RequirementRequestCollection;
use App\Http\Resources\V1\Uic\RequirementRequestResource;

class RequirementRequestRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexRequirementRequestRequest $request
     * @return RequirementRequestCollection
     */
    public function index(IndexRequirementRequestRequest $request)
    {
        $sorts = explode(',', $request->sort);
        
        $requirements = RequirementRequest::customSelect($request->fields)->customOrderBy($sorts)
        ->paginate($request->input('per_page'));
        
        return (new RequirementRequestCollection($requirements))
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
     * @param  StoreRequirementRequestRequest $request
     * @return RequirementRequestResource
     */
    public function store(StoreRequirementRequestRequest $request)
        {
    
            $requirement = Requirement::find($request->input('requirement.id'));
            $meshStudent = meshStudent::find($request->input('mesh_student.id'));
    
            $requirement = new RequirementRequest;
    
            $requirement->requirement()->associate($requirement);
            $requirement->meshStudent()->associate($meshStudent);
    
            $requirement->registered_at = $request->input('registeredAt');
            $requirement->approved = $request->input('approved');
            $requirement->observations = $request->input('observations');
            $requirement->save();
            
            return (new RequirementRequestResource($requirement))
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
     * @param  RequirementRequest $requirement
     * @return Requirement
     */
    public function show(RequirementRequest $requirement)
    {
        return (new Requirement($requirement))
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
     * @param  UpdateRequirementRequestRequest $request
     * @param  Requirement $requirement
     * @return RequirementRequestResource
     */
    public function update(UpdateRequirementRequestRequest $request,  Requirement $requirement)
    {
        $requirement = Requirement::find($request->input('requirement.id'));
        $meshStudent = meshStudent::find($request->input('mesh_student.id'));

        $requirement->requirement()->associate($requirement);
        $requirement->meshStudent()->associate($meshStudent);

        $requirement->registered_at = $request->input('registeredAt');
        $requirement->approved = $request->input('approved');
        $requirement->observations = $request->input('observations');
        $requirement->save();
        
        return (new RequirementRequestResource($requirement))
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
     * @param  RequirementRequest $requirement
     * @return RequirementRequestResource
     */
    public function destroy(RequirementRequest $requirement)
    {
        $requirement->delete();
        return (new RequirementRequestResource($requirement))
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
     * @param DestroysRequirementRequestRequest $request
     * @return RequirementRequestCollection
     */
    public function destroys(DestroysRequirementRequestRequest $request)
    {
        $requirement = RequirementRequest::whereIn('id', $request->input('ids'))->get();
        RequirementRequest::destroy($request->input('ids'));

        return (new RequirementRequestCollection($requirement))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
