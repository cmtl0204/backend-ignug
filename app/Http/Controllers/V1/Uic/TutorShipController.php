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
    public function index(){
        $tutor = TutorShip::orderBy('id', 'asc')->get();
        return response()->json($tutor);
    }

    public function show($id){
        $tutors = TutorShip::findOrFail($id);
            return response()->json([ $tutors
            ], 200);  
    }

    public function store(Request $request){
        $tutor = Tutor::find($request->input('tutor_id'));
        $enrollment = Enrollment::find($request->input('enrollment_id'));
        $tutorship = new TutorShip();
        //$tutorship->tutor_id = $request->input('tutor_id');
        //$tutorship->enrollment_id = $request->input('enrollment_id');
        $tutorship->tutor()->associate($tutor);
        $tutorship->enrollment()->associate($enrollment);
        $tutorship->topics = $request->input('topics');
        $tutorship->date = $request->input('date');
        $tutorship->start_hour = $request->input('start_hour');
        $tutorship->end_hour = $request->input('end_hour');
        $tutorship->duration = $request->input('duration');
        $tutorship->percentage_advance = $request->input('percentage_advance');
        $tutorship->save();
        return response()->json([
            'data' => $tutorship->fresh(),
            'msg' => [
                'summary' => 'tutoria creada',
                'detail' => 'La tutoria fue creado',
                'code' => '201'
            ]
        ], 201);
    }

    public function update(Request $request, $id){
        $tutor = Tutor::find($request->input('tutor_id'));
        $enrollment = Enrollment::find($request->input('enrollment_id'));
        $project = $enrollment->projects()->first();
        $tutorship = TutorShip::find($id);
        if (!$tutorship) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El tutor no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }
       // $tutorship->tutor_id = $request->input('tutor_id');
      //  $tutorship->enrollment_id = $request->input('enrollment_id');
        $tutorship->tutor()->associate($tutor);
        $tutorship->enrollment()->associate($enrollment);
        $tutorship->topics = $request->input('topics');
        $tutorship->date = $request->input('date');
        $tutorship->start_hour = $request->input('start_hour');
        $tutorship->end_hour = $request->input('end_hour');
        $tutorship->duration = $request->input('duration');
        $tutorship->percentage_advance = $request->input('percentage_advance');
        $tutorship->save();
        $project->total_advance=$project->total_advance + $request->input('percentage_advance');
        $project->save();
        return response()->json([
            'data' => $tutorship->fresh(),
            'msg' => [
                'summary' => 'tutoria actualizada',
                'detail' => 'La tutoria fue actualizada',
                'code' => '201'
            ]
        ], 201);
        
    }

    public function destroy($id){
        $tutorship = TutorShip::findOrFail($id);
        $tutorship->delete();
        return response()->json([
            'data' => null,
            'msg' => [
                'summary' => 'Tutorias eliminado(s)',
                'detail' => 'Se eliminó correctamente',
                'code' => '201'
            ]
        ], 201);
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
