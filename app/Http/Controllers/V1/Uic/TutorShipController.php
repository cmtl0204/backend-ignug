<?php

namespace App\Http\Controllers\Uic;
use App\Http\Controllers\Controller;
use App\Models\Uic\TutorShip;
use Illuminate\Http\Request;
use App\Models\Uic\Tutor;
use App\Models\Uic\Enrollment;
use App\Models\App\Teacher;
use App\Models\Authentication\User;

class TutorShipController extends Controller
{
    public function index(IndexTutorShipRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $tutorShips = TutorShip::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new TutorShipCollection($tutorShips))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(TutorShip $tutorship)
    {
        return (new TutorShipResource($tutorship))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function store(Request $request)
    {
        $tutor = Tutor::find($request->input('tutor.id'));
        $enrollment = Enrollment::find($request->input('enrollment.id'));

        $tutorship = new TutorShip();
     
        $tutorship->tutor()->associate($tutor);
        $tutorship->enrollment()->associate($enrollment);

        $tutorship->topics = $request->input('topics');
        $tutorship->started_at = $request->input('startedAt');
        $tutorship->time_started_at = $request->input('timeStartedAt');
        $tutorship->time_ended_at = $request->input('timeEndedAt');
        $tutorship->duration = $request->input('duration');
        $tutorship->percentage_advance = $request->input('percentageAdvance');
        $tutorship->save();
        
        return (new TutorShipResource($tutorship))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function update(Request $request,  Tutorship $tutorship)
    {
        
        $tutor = Tutor::find($request->input('tutor.id'));
        $enrollment = Enrollment::find($request->input('enrollment.id'));
     
        $tutorship->tutor()->associate($tutor);
        $tutorship->enrollment()->associate($enrollment);

        $tutorship->topics = $request->input('topics');
        $tutorship->started_at = $request->input('startedAt');
        $tutorship->time_started_at = $request->input('timeStartedAt');
        $tutorship->time_ended_at = $request->input('timeEndedAt');
        $tutorship->duration = $request->input('duration');
        $tutorship->percentage_advance = $request->input('percentageAdvance');
        $tutorship->save();
        
        return (new TutorShipResource($tutorship))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);  
    }

    public function destroy(TutorShip $tutorShip)
    {
        $tutorShip->delete();
        return (new TutorShipResource($tutorShip))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysTutorShipRequest $tutorShip)
    {
        $tutorShip = TutorShip::whereIn('id', $request->input('ids'))->get();
        TutorShip::destroy($request->input('ids'));

        return (new TutorShipCollection($tutorShip))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
//For the Moment
    public function Teachers(){
        $teacher = Teacher::orderBy('id', 'asc')->get();
        return response()->json($teacher);
    }

    public function Users(){
        $user = User::orderBy('id', 'asc')->get();
        return response()->json($user);
    }
}
