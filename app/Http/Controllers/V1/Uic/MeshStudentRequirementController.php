<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\App\FileController;
use App\Http\Controllers\Controller;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\Uic\MeshStudentRequirement\DeleteMeshStudentRequirementRequest;
use App\Http\Requests\Uic\MeshStudentRequirement\DisapprovedMeshStudentRequirementRequest;
use App\Http\Requests\Uic\MeshStudentRequirement\StoreMeshStudentRequirementRequest;
use App\Http\Requests\Uic\MeshStudentRequirement\UpdateMeshStudentRequirementRequest;
use App\Http\Requests\Uic\MeshStudentRequirement\IndexMeshStudentRequirementRequest;
use App\Models\Uic\MeshStudentRequirement;
use App\Models\Uic\Requirement;
use Illuminate\Http\Request;

class MeshStudentRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexMeshStudentRequirementRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $meshStudentRequirement = MeshStudentRequirement::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new MeshStudentRequirementCollection($meshStudentRequirement))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function store(Request $request)
    {

        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $requirement = Requirement::find($request->input('requirement.id'));

        $MeshStudent = new MeshStudent();

        $MeshStudent->meshStudent()->associate($meshStudent);
        $MeshStudent->requirement()->associate($requirement);

        $MeshStudent->approved = $request->input('approved');
        $MeshStudent->observations = $request->input('observations');
        $MeshStudent->save();

        return (new MeshStudentResource($MeshStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(MeshStudentRequirement $meshStudentRequirement)
    {
        return (new EMeshStudentRequirementResource($meshStudentRequirement))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(UpdateMeshStudentRequirementRequest $request,  MeshStudent $MeshStudent)
    {
        
        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $requirement = Requirement::find($request->input('requirement.id'));

        $MeshStudent->meshStudent()->associate($meshStudent);
        $MeshStudent->requirement()->associate($requirement);

        $MeshStudent->approved = $request->input('approved');
        $MeshStudent->observations = $request->input('observations');
        $MeshStudent->save();
        
        return (new ExampleResource($example))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function approve(MeshStudentRequirement $meshStudentRequirement)
    {
        if (!$meshStudentRequirement) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El requerimiento no existe',
                    'detail' => 'Intente con otro registro',
                    'code' => '404'
                ]
            ], 400);
        }
        $meshStudentRequirement->is_approved = true;
        $meshStudentRequirement->save();
        return response()->json([
            'data' => $meshStudentRequirement,
            'msg' => [
                'summary' => 'Requerimiento aprobado',
                'detail' => 'El registro fue actualizado',
                'code' => '201'
            ]
        ], 201);
    }

    public function reject(DisapprovedMeshStudentRequirementRequest $request, MeshStudentRequirement $meshStudentRequirement)
    {
        if (!$meshStudentRequirement) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El requerimiento no existe',
                    'detail' => 'Intente con otro registro',
                    'code' => '404'
                ]
            ], 400);
        }
        $meshStudentRequirement->is_approved = false;
        $meshStudentRequirement->observations = $request->input('meshStudentRequirement.observations');;
        $meshStudentRequirement->save();
        return response()->json([
            'data' => $meshStudentRequirement,
            'msg' => [
                'summary' => 'Requerimiento rechazado',
                'detail' => 'El registro fue actualizado',
                'code' => '201'
            ]
        ], 201);
    }

    public function destroy(MeshStudentRequirement $meshStudentRequirement)
    {
        $meshStudentRequirement->delete();
        return (new MeshStudentRequirementResource($meshStudentRequirement))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysMeshStudentRequirementRequest $request)
    {
        $meshStudentRequirement = MeshStudentRequirement::whereIn('id', $request->input('ids'))->get();
        MeshStudentRequirement::destroy($request->input('ids'));

        return (new ExampleCollection($meshStudentRequirement))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    function uploadFile(UploadFileRequest $request)
    {
        return (new FileController())->upload($request, MeshStudentRequirement::getInstance($request->input('id')));
    }

    public function updateFile(UpdateFileRequest $request)
    {
        return (new FileController())->update($request, MeshStudentRequirement::getInstance($request->input('id')));
    }

    function deleteFile($fileId)
    {
        return (new FileController())->delete($fileId);
    }

    function indexFile(IndexFileRequest $request)
    {
        return (new FileController())->index($request, MeshStudentRequirement::getInstance($request->input('id')));
    }

    function ShowFile($fileId)
    {
        return (new FileController())->show($fileId);
    }
}
