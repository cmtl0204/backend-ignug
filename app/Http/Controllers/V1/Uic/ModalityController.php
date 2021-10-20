<?php

namespace App\Http\Controllers\Uic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Uic\Modality\DeleteModalityRequest;
use App\Http\Requests\Uic\Modality\IndexModalityRequest;
use App\Http\Requests\Uic\Modality\StoreModalityRequest;
use App\Http\Requests\Uic\Modality\UpdateModalityRequest;
use App\Models\App\Career;
use App\Models\App\Catalogue;
use App\Models\Uic\Modality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// Models

// FormRequest en el index store update

class ModalityController extends Controller
{
    //Obtener modalidades
    public function index(IndexModalityRequest $request)
    {
        $sorts = explode(',', $request->sort);

        $modalitys = Modality::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
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
