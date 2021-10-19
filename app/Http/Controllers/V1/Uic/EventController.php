<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Event\DestroyEventRequest;
use App\Http\Requests\Uic\Event\DestroysEventRequest;
use App\Http\Requests\Uic\Event\IndexEventRequest;
use App\Http\Requests\Uic\Event\StoreEventRequest;
use App\Http\Requests\Uic\Event\UpdateEventRequest;
use App\Models\Uic\Event;
use App\Models\Uic\Planning;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// Models

// FormRequest en el index store update

class EventController extends Controller
{
    public function index(IndexEventRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $examples = Event::customSelect($request->fields)->customOrderBy($sorts)
            ->fielEvent($request->input('fieldEvent'))
            ->paginate($request->input('per_page'));

        return (new EventCollection($examples))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function store(StoreEventRequest $request)
    {
        $event = new Event;
        $planning = Planning::findOrFail($request->input('event.planning.id'));


        if (
            $planning['start_date'] <= $request->input('event.start_date')
            && $planning['end_date'] >= $request->input('event.end_date')
        ) {
            $event->planning_id = $request->input('event.planning.id');
            $event->name_id = $request->input('event.name.id');
            $event->start_date = $request->input('event.start_date');
            $event->end_date = $request->input('event.end_date');
            $event->save();
            
            return (new EventResource($event))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
        }
    }

    public function show(Event $event)
    {
        return (new EventResource($event))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'El evento no existe',
                    'detail' => 'Intente otra vez',
                    'code' => '404'
                ]
            ], 400);
        }
        $planning = Planning::findOrFail($request->input('event.planning.id'));
        if ($planning['start_date'] <= $request->input('event.start_date') && $planning['end_date'] >= $request->input('event.end_date')) {
            $event->planning_id = $request->input('event.planning.id');
            $event->name_id = $request->input('event.name.id');
            $event->start_date = $request->input('event.start_date');
            $event->end_date = $request->input('event.end_date');
            $event->save();
            
            return (new EventResource($event))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return (new EventResource($event))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroys(DestroysEventRequest $request)
    {
        $event = Event::whereIn('id', $request->input('ids'))->get();
        Event::destroy($request->input('ids'));

        return (new EventCollection($event))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
