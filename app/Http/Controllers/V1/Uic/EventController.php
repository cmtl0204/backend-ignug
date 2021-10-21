<?php
//Models
//Controllers
//Resources


namespace App\Http\Controllers\Uic;

//Models
use App\Models\Uic\Event;
use App\Models\Uic\Planning;
use App\Models\Uic\Catalogue;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Events\DestroysEventRequest;
use App\Http\Requests\V1\Uic\Events\IndexEventRequest;
use App\Http\Requests\V1\Uic\Events\StoreEventRequest;
use App\Http\Requests\V1\Uic\Events\UpdateEventRequest;

//Resources
use App\Http\Resources\V1\Uic\EventCollection;
use App\Http\Resources\V1\Uic\EventResource;

class EventController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @param  IndexEventRequest $request
     * @return EventCollection
     */
    public function index(IndexEventRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $events = Event::customSelect($request->fields)->customOrderBy($sorts)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEvenRequest $request
     * @return EvenResource
     */
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

    /**
     * Display the specified resource.
     *
     * @param  Event $event
     * @return EventResource
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEventRequest $request
     * @param  Event $event
     * @return EventResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event $event
     * @return EventResource
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroysEventRequest $request
     * @return EventCollection
     */
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
