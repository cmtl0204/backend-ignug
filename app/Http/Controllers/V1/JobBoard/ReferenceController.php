<?php

namespace App\Http\Controllers\V1\JobBoard;
// Controllers
use App\Http\Controllers\Controller;
// FormRequests
use App\Http\Requests\JobBoard\Reference\CreateReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\IndexReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\UpdateReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\StoreReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\DeleteReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\GetReferenceRequest;
use App\Http\Requests\V1\JobBoard\Reference\DestroysReferenceRequest;

use App\Http\Controllers\App\FileController;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Models\JobBoard\Category;

// Models
use App\Models\JobBoard\Reference;
use App\Models\JobBoard\Professional;
use App\Models\App\Catalogue;

// Resources
use App\Http\Resources\V1\JobBoard\ReferenceCollection;
use App\Http\Resources\V1\JobBoard\ReferenceResource;

use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    function  test(Request $request)
    {
        return Professional::select('about_me', 'has_travel')->with('course')->get();
    }

    function index(IndexReferenceRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $references = $professional->references()
            ->customOrderBy($sorts)
            ->position($request->input('position'))
            ->contactName($request->input('contactName'))
            ->contactPhone($request->input('contactPhone'))
            ->contactEmail($request->input('contactEmail'))
            ->paginate($request->per_page);

        return (new ReferenceCollection($references))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Professional $professional, Reference $reference)
    {
        return (new ReferenceResource($reference))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function store(StoreReferenceRequest $request, Professional $professional)
    {
        $reference = new Reference();
        $reference->professional()->associate($professional);
        $reference->institution = $request->input('institution');
        $reference->position = $request->input('position');
        $reference->contact_name = $request->input('contactName');
        $reference->contact_phone = $request->input('contactPhone');
        $reference->contact_email = $request->input('contactEmail');
        $reference->save();

        return (new ReferenceResource($reference))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }


    function update(UpdateReferenceRequest $request, Professional $professional, Reference $reference)
    {
        $reference->institution = $request->input('institution');
        $reference->position = $request->input('position');
        $reference->contact_name = $request->input('contactName');
        $reference->contact_phone = $request->input('contactPhone');
        $reference->contact_email = $request->input('contactEmail');
        $reference->save();

        return (new ReferenceResource($reference))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }


    public function destroy(Professional $professional, Reference $reference)
    {
        $reference->delete();
        return (new ReferenceResource($reference))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysReferenceRequest $request)
    {
        $references = Reference::whereIn('id', $request->input('ids'))->get();
        Reference::destroy($request->input('ids'));

        return (new ReferenceCollection($references))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    // function deleteFile($fileId)
    // {
    //     return (new FileController())->delete($fileId);
    // }

    // function uploadFiles(UploadFileRequest $request)
    // {
    //     return (new FileController())->upload($request, Reference::getInstance($request->input('id')));
    // }

    // function indexFile(IndexFileRequest $request)
    // {
    //     return (new FileController())->index($request, Reference::getInstance($request->input('id')));
    // }

    // function ShowFile($fileId)
    // {
    //     return (new FileController())->show($fileId);
    // }
}
