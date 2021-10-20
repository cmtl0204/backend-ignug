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

        $enrollments = Enrollment::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldEnrollment'))
            ->paginate($request->input('per_page'));

        return (new EnrollmentCollection($enrollments))
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
        $modality = Modality::find($request->input('modality.id'));
        $schoolPeriod = SchoolPeriod::find($request->input('schoolPeriod.id'));
        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $status = Status::find($request->input('status.id'));
        $planning = Planning::find($request->input('planning.id'));

        $enrollment = new Enrollment;

        $enrollment->modality()->associate($modality);
        $enrollment->schoolPeriod()->associate($schoolPeriod);
        $enrollment->meshStudent()->associate($meshStudent);
        $enrollment->status()->associate($status);
        $enrollment->planning()->associate($planning);

        $enrollment->registered_at = $request->input('registeredAt');
        $enrollment->code = $request->input('code');
        $enrollment->observations = $request->input('observations');
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

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $modality = Modality::find($request->input('modality.id'));
        $schoolPeriod = SchoolPeriod::find($request->input('schoolPeriod.id'));
        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $status = Status::find($request->input('status.id'));
        $planning = Planning::find($request->input('planning.id'));

        $enrollment->modality()->associate($modality);
        $enrollment->schoolPeriod()->associate($schoolPeriod);
        $enrollment->meshStudent()->associate($meshStudent);
        $enrollment->status()->associate($status);
        $enrollment->planning()->associate($planning);

        $enrollment->registered_at = $request->input('registeredAt');
        $enrollment->code = $request->input('code');
        $enrollment->observations = $request->input('observations');
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
