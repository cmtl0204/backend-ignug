<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Enrollment\DestroyMeshStudentRequest;
use App\Http\Requests\Uic\Enrollment\DestroysMeshStudentRequest;
use App\Http\Requests\Uic\MeshStudent\IndexMeshStudentRequest;
use App\Http\Requests\Uic\Enrollment\StoreMeshStudentRequest;
use App\Http\Requests\Uic\Enrollment\UpdateMeshStudentRequest;
use App\Models\App\MeshStudent;

// Models

// FormRequest en el index store update

class MeshStudentController extends Controller
{
    public function index(IndexMeshStudentRequest $request)
    {
        if ($request->has('per_page')) {
            $student = MeshStudent::with('meshStudentRequirements')->paginate($request->input('per_page'));
        } else {
            $student = MeshStudent::with('meshStudentRequirements')->get();
        }

        if ($student->count() === 0) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'No se encontraron estudiantes',
                    'detail' => 'Intentelo de nuevo',
                    'code' => '404'
                ]
            ], 404);
        }
        return response()->json($student, 200);
    }

    public function store(StoreMeshStudentRequest $request)
    {

        $student = Student::find($request->input('student.id'));
        $mesh = mesh::find($request->input('mesh.id'));

        $MeshStudent = new MeshStudent();

        $MeshStudent->student()->associate($student);
        $MeshStudent->mesh()->associate($mesh);

        $MeshStudent->startCohort = $request->input('startCohort');
        $MeshStudent->endCohort = $request->input('endCohort');
        $MeshStudent->isGraduated = $request->input('isGraduated');
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

    public function show(MeshStudent $request)
    {
        return (new MeshStudentResource($request))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(UpdateMeshStudentRequest $request, MeshStudent $MeshStudent)
    {
        $student = Student::find($request->input('student.id'));
        $mesh = mesh::find($request->input('mesh.id'));

        $MeshStudent->student()->associate($student);
        $MeshStudent->mesh()->associate($mesh);

        $MeshStudent->startCohort = $request->input('startCohort');
        $MeshStudent->endCohort = $request->input('endCohort');
        $MeshStudent->isGraduated = $request->input('isGraduated');
        $MeshStudent->save();

        return (new MeshStudentResource($request))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(MeshStudent $request)
    {
        $request->delete();
        return (new MeshStudentResource($request))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysMeshStudentRequest $request)
    {
        $MeshStudent = MeshStudent::whereIn('id', $request->input('ids'))->get();
        MeshStudent::destroy($request->input('ids'));

        return (new MeshStudentCollection($meshStudent))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
