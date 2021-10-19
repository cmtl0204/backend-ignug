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

        $modality = Modality::customSelect($request->fields)->customOrderBy($sorts)
            ->fielExample($request->input('fieldExample'))
            ->paginate($request->input('per_page'));

        return (new ModalityCollection($modality))
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
        $modality = new Modality;
        $modality->parent_id = $request->input('modality.parent_id');
        $modality->career_id = $request->input('modality.career_id');
        $modality->name = $request->input('modality.name');
        $modality->description = ($request->input('modality.description'));
        $modality->status_id = $request->input('modality.status_id');
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

    public function update(UpdateModalityRequest $request, $modality)
    {
        $modality = Modality::find($modality);
        if (!$modality) {
            return response()->json([
                'data' => null,
                'msg' => [
                    'summary' => 'La modalidad no existe',
                    'detail' => 'Intente con otra modalidad',
                    'code' => '404'
                ]
            ], 400);
        }
        $modality->parent_id = $request->input('modality.parent_id');
        $modality->career_id = $request->input('modality.career_id');
        $modality->name = $request->input('modality.name');
        $modality->description = $request->input('modality.description');
        $modality->status_id = $request->input('modality.status_id');
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
