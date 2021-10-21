<?php

namespace App\Http\Controllers\Uic;

//Models
use App\Models\App\Career;
use App\Models\Uic\Modality;
use App\Models\Uic\Status;

//Controllers
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Uic\Modalities\IndexModalityRequest;
use App\Http\Requests\V1\Uic\Modalities\StoreModalityRequest;
use App\Http\Requests\V1\Uic\Modalities\UpdateModalityRequest;
use App\Http\Requests\V1\Uic\Modalities\DestroysModalityRequest;

//Resources
use App\Http\Resources\V1\Uic\ModalityCollection;
use App\Http\Resources\V1\Uic\ModalityResource;

class ModalityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @param  IndexModalityRequest $request
     * @return ModalityCollection
     */
    public function index(IndexModalityRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $modalitys = Modality::customSelect($request->fields)->customOrderBy($sorts)
            ->name($request->input('name'))
            ->description($request->input('description'))
            ->paginate($request->input('per_page'));

        return (new ModalityCollection($modalitys))
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
     * @param  StoreModalityRequest $request
     * @return ModalityResource
     */
    public function store(StoreModalityRequest $request)
    {
        $parent = Modality::find($request->input('parent.id'));
        $status = Status::find($request->input('status.id'));
        $career = Career::find($request->input('career.id'));

        $modality = new Modality;

        $modality->parent()->associate($parent);
        $modality->status()->associate($status);
        $modality->career()->associate($career);

        $modality->name = $request->input('name');
        $modality->description = $request->input('description');
        $modality->save();
        
        return (new ModalityResource($modality))
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
     * @param  Modality $modality
     * @return ModalityResource
     */
    public function showModalities(Modality $modality)
    {
        return (new ModalityResource($modality))
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
     * @param  UpdateModalityRequest $request
     * @param  Modality $modality
     * @return ModalityResource
     */
    public function update(UpdateModalityRequest $request, Modality $modality)
    {
        $parent = Modality::find($request->input('parent.id'));
        $status = Status::find($request->input('status.id'));
        $career = Career::find($request->input('career.id'));

        $modality->parent()->associate($parent);
        $modality->status()->associate($status);
        $modality->career()->associate($career);

        $modality->name = $request->input('name');
        $modality->description = $request->input('description');
        $modality->save();
        
        return (new ModalityResource($modality))
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
     * @param  Modality $modality
     * @return ModalityResource
     */
    public function destroy(Modality $modality)
    {
        $modality->delete();
        return (new ModalityResource($modality))
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
     * @param DestroysModalityRequest $request
     * @return ModalityCollection
     */
    public function destroys(DestroysModalityRequest $request)
    {
        $modality = Modality::whereIn('id', $request->input('ids'))->get();
        Modality::destroy($request->input('ids'));

        return (new ModalityCollection($modality))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
}
