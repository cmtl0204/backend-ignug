<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\App\FileController;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\Uic\Requirement\IndexRequirementRequest;
use App\Http\Requests\Uic\Requirement\DeleteRequirementRequest;
use App\Http\Requests\Uic\Requirement\StoreRequirementRequest;
use App\Http\Requests\Uic\Requirement\UpdateRequirementRequest;

use App\Models\Uic\Requirement;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequirementRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $examples = Requirement::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldRequirement'))
            ->paginate($request->input('per_page'));

        return (new RequirementCollection($examples))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

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

    public function store(StoreRequirementRequest $request)
    {
        $requirement = new Requirement;
        $requirement->career_id = $request->input('requirement.career.id');
        $requirement->name = $request->input('requirement.name');
        $requirement->is_required = $request->input('requirement.is_required');
        $requirement->is_solicitable = $request->input('requirement.is_solicitable');
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

    public function update(UpdateRequirementRequest $request, $id)
    {
        $requirement = Requirement::find($id);
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
        $requirement->career_id = $request->input('requirement.career.id');
        $requirement->name = $request->input('requirement.name');
        $requirement->is_required = $request->input('requirement.is_required');
        $requirement->is_solicitable = $request->input('requirement.is_solicitable');
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

    public function destroys(DestroysCustomRequest $request)
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