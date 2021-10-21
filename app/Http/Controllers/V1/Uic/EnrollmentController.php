<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Enrollment;
use App\Models\Uic\Modality;
use App\Models\Uic\SchoolPeriod;
use App\Models\Uic\MeshStudent;
use App\Models\Uic\Planning;
use App\Models\Core\State;

// Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Enrollments\DestroysEnrollmentRequest;
use App\Http\Requests\V1\Uic\Enrollments\IndexEnrollmentRequest;
use App\Http\Requests\V1\Uic\Enrollments\StoreEnrollmentRequest;
use App\Http\Requests\V1\Uic\Enrollments\UpdateEnrollmentRequest;

//Resources
use App\Http\Resources\V1\Uic\EnrollmentCollection;
use App\Http\Resources\V1\Uic\EnrollmentResource;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  IndexEnrollmentRequest $request
     * @return EnrollmentCollection
     */
    public function index(IndexEnrollmentRequest $request)
    {

        $sorts = explode(',', $request->sort);

        $enrollments = Enrollment::customSelect($request->fields)->customOrderBy($sorts)
            ->code($request->input('code'))
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEnrollmentRequest $request
     * @return EnrollmentResource
     */
    public function store(StoreEnrollmentRequest $request)
    {   
        $modality = Modality::find($request->input('modality.id'));
        $schoolPeriod = SchoolPeriod::find($request->input('schoolPeriod.id'));
        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $state = State::find($request->input('state.id'));
        $planning = Planning::find($request->input('planning.id'));

        $enrollment = new Enrollment;

        $enrollment->modality()->associate($modality);
        $enrollment->schoolPeriod()->associate($schoolPeriod);
        $enrollment->meshStudent()->associate($meshStudent);
        $enrollment->state()->associate($state);
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

    /**
     * Display the specified resource.
     *
     * @param  Enrollment $enrollment
     * @return EnrollmentResource
     */
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

    /**
     * Display the specified resource.
     * @param  UpdateEnrollmentRequest $request
     * @param  Enrollment $enrollment
     * @return EnrollmentResource
     */
    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment)
    {
        $modality = Modality::find($request->input('modality.id'));
        $schoolPeriod = SchoolPeriod::find($request->input('schoolPeriod.id'));
        $meshStudent = MeshStudent::find($request->input('meshStudent.id'));
        $state = State::find($request->input('state.id'));
        $planning = Planning::find($request->input('planning.id'));

        $enrollment->modality()->associate($modality);
        $enrollment->schoolPeriod()->associate($schoolPeriod);
        $enrollment->meshStudent()->associate($meshStudent);
        $enrollment->state()->associate($state);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Enrollment $enrollment
     * @return EnrollmentResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysEnrollmenRequest $request
     * @return EnrollmenCollection
     */
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
