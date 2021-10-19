<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Enrollment\DestroyEnrollmentRequest;
use App\Http\Requests\Uic\Enrollment\DestroysEnrollmentRequest;
use App\Http\Requests\Uic\Enrollment\IndexEnrollmentRequest;
use App\Http\Requests\Uic\Enrollment\StoreEnrollmentRequest;
use App\Http\Requests\Uic\Enrollment\UpdateEnrollmentRequest;
use App\Models\Uic\Enrollment;
// Models

// FormRequest en el index store update

class EnrollmentController extends Controller
{
    public function index(IndexEnrollmentRequest $request)
    {

        $sorts = explode(',', $request->sort);

        $enrollment = Enrollment::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldEnrollment'))
            ->paginate($request->input('per_page'));

        return (new EnrollmentCollection($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function store(StoreEnrollmentRequest $request)
    {
        $enrollment = new Enrollment;
        $enrollment->modality_id = $request->input('enrollment.modality.id');
        $enrollment->school_period_id = $request->input('enrollment.schoolPeriod.id');
        $enrollment->planning_id = $request->input('enrollment.planning.id');
        $enrollment->mesh_student_id = $request->input('enrollmentMeshStudent.id');
        $enrollment->date = $request->input('enrollment.date');
        $enrollment->code = $request->input('enrollment.code');
        $enrollment->status_id = $request->input('enrollment.status.id');
        $enrollment->observations = $request->input('enrollment.observations');
        $enrollment->save();
        
        return (new EnrollmentResource($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(Enrollment $enrollment)
    {
        return (new EnrollmentResource($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(UpdateEnrollmentRequest $request, $id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'La inscripción no existe',
                    'detail' => 'Intente con otra inscripción',
                    'code' => '404'
                ]
            ], 400);
        }
        $enrollment->modality_id = $request->input('enrollment.modality.id');
        $enrollment->school_period_id = $request->input('enrollment.schoolPeriod.id');
        $enrollment->planning_id = $request->input('enrollment.planning.id');
        $enrollment->mesh_student_id = $request->input('enrollmentMeshStudent.id');
        $enrollment->date = $request->input('enrollment.date');
        $enrollment->code = $request->input('enrollment.code');
        $enrollment->status_id = $request->input('enrollment.status.id');
        $enrollment->observations = $request->input('enrollment.observations');
        $enrollment->save();
        
        return (new EnrollmentResource($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return (new EnrollmentResource($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }
    public function destroys(DestroysEnrollmentRequest $request)
    {
        $enrollment = Enrollment::whereIn('id', $request->input('ids'))->get();
        Enrollment::destroy($request->input('ids'));

        return (new EnrollmentCollection($enrollment))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
