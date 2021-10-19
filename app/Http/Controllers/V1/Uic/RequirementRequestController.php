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

        $examples = RequirementRequest::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new RequirementRequestCollection($requirement))
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
        $requirement = new RequirementRequest;
        $requirement->requirement_id = $request->input('requirementRequest.requirement.id');
        $requirement->mesh_student_id = $request->input('requirementRequest.mesh_student.id');
        $requirement->date = $request->input('requirementRequest.date');
        $requirement->is_approved = $request->input('requirementRequest.is_approved');
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

    public function update(UpdateRequirementRequestRequest $request, $id)
    {
        $requirement = RequirementRequest::find($id);
        if (!$requirement) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El requerimiento no existe',
                    'detail' => 'Intente con otro requerimiento',
                    'code' => '404'
                ]
            ], 400);
        }
        $requirement->requirement_id = $request->input('requirementRequest.requirement.id');
        $requirement->mesh_student_id = $request->input('requirementRequest.mesh_student.id');
        $requirement->date = $request->input('requirementRequest.date');
        $requirement->is_approved = $request->input('requirementRequest.is_approved');
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
