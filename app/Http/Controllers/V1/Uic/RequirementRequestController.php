<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\App\FileController;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\Uic\RequirementRequest\IndexRequirementRequestRequest;
use App\Http\Requests\Uic\RequirementRequest\DeleteRequirementRequestRequest;
use App\Http\Requests\Uic\RequirementRequest\StoreRequirementRequestRequest;
use App\Http\Requests\Uic\RequirementRequest\UpdateRequirementRequestRequest;

use App\Models\Uic\RequirementRequest;

class RequirementRequestRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequirementRequestRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $requirements = RequirementRequest::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
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

    public function destroys(DestroysCustomRequest $request)
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
