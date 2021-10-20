<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\App\MeshStudent;
use App\Models\App\Mesh;
use App\Models\App\Student;
//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\MeshStudents\DestroysMeshStudentRequest;
use App\Http\Requests\V1\Uic\MeshStudents\IndexMeshStudentRequest;
use App\Http\Requests\V1\Uic\MeshStudents\StoreMeshStudentRequest;
use App\Http\Requests\V1\Uic\MeshStudents\UpdateMeshStudentRequest;

//Resources
use App\Http\Resources\V1\Uic\MeshStudentCollection;
use App\Http\Resources\V1\Uic\MeshStudentResource;

class MeshStudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  IndexMeshStudenRequest $request
     * @return MeshStudenCollection
     */
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
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMeshStudentRequest $request
     * @return MeshStudentResource
     */
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

    /**
     * Display the specified resource.
     *
     * @param  MeshStudent $request
     * @return MeshStudentResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateMeshStudentRequest $request
     * @param  MeshStudent $MeshStudent
     * @return MeshStudentResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  MeshStudent $request
     * @return MeshStudentResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysMeshStudentRequest $request
     * @return MeshStudentCollection
     */
    public function destroys(DestroysMeshStudentRequest $request)
    {
        $meshStudent = MeshStudent::whereIn('id', $request->input('ids'))->get();
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
