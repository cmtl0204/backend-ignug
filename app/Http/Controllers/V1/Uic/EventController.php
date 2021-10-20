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

        $events = Event::customSelect($request->fields)->customOrderBy($sorts)
            ->fielEvent($request->input('fieldEvent'))
            ->paginate($request->input('per_page'));

        return (new EventCollection($events))
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
        $planning = Planning::find($request->input('planning.id'));
        $name = Catalogue::find($request->input('name.id'));
        
        $event = new Event;

        $event->planning()->associate($planning);
        $event->name()->associate($name);
        
        $event->started_at = $request->input('startedAt');
        $event->ended_at = $request->input('endedAt');
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

    public function update(UpdateEventRequest $request, Event $event)
    {
        $planning = Planning::find($request->input('planning.id'));
        $name = Catalogue::find($request->input('name.id'));

        $event->planning()->associate($planning);
        $event->name()->associate($name);
        
        $event->started_at = $request->input('startedAt');
        $event->ended_at = $request->input('endedAt');
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
