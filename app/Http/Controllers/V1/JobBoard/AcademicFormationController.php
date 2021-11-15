<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;

// Models
use App\Models\Core\Career;
use App\Models\Core\File;
use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Category;
use App\Models\JobBoard\Professional;

// Resources
use App\Http\Resources\V1\JobBoard\AcademicFormationCollection;
use App\Http\Resources\V1\JobBoard\AcademicFormationResource;

// Requests
use App\Http\Requests\V1\JobBoard\AcademicFormation\DestroysAcademicFormationRequest;
use App\Http\Requests\V1\JobBoard\AcademicFormation\IndexAcademicFormationRequest;
use App\Http\Requests\V1\JobBoard\AcademicFormation\StoreAcademicFormationRequest;
use App\Http\Requests\V1\JobBoard\AcademicFormation\UpdateAcademicFormationRequest;

use App\Http\Requests\V1\Core\Files\DestroysFileRequest;
use App\Http\Requests\V1\Core\Files\IndexFileRequest;
use App\Http\Requests\V1\Core\Files\UpdateFileRequest;
use App\Http\Requests\V1\Core\Files\UploadFileRequest;

class AcademicFormationController extends Controller
{
    public function index(IndexAcademicFormationRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $academicFormations = $professional->academicFormations()
            ->customOrderBy($sorts)
            ->senescytCode($request->input('senescytCode'))
            ->paginate($request->per_page);

        return (new AcademicFormationCollection($academicFormations))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function store(StoreAcademicFormationRequest $request, Professional $professional)
    {
        $academicFormation = new AcademicFormation();
        $academicFormation->professional()->associate($professional);
        $academicFormation->professionalDegree()->associate(Category::find($request->input('professionalDegree.id')));
        $academicFormation->career()->associate(Career::find($request->input('career.id')));
        $academicFormation->certificated = $request->input('certificated');

        if ($request->input('certificated')) {
            $academicFormation->registered_at = $request->input('registeredAt');
            $academicFormation->senescyt_code = $request->input('senescytCode');
        }

        $academicFormation->save();

        return (new AcademicFormationResource($academicFormation))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function show(Professional $professional, AcademicFormation $academicFormation)
    {
        return (new AcademicFormationResource($academicFormation))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function update(UpdateAcademicFormationRequest $request, Professional $professional, AcademicFormation $academicFormation)
    {
        $academicFormation->professionalDegree()->associate(Category::find($request->input('professionalDegree.id')));
        $academicFormation->career()->associate(Career::find($request->input('career.id')));
        $academicFormation->certificated = $request->input('certificated');

        if ($request->input('certificated')) {
            $academicFormation->registered_at = $request->input('registeredAt');
            $academicFormation->senescyt_code = $request->input('senescytCode');
        }else{
            $academicFormation->registered_at = null;
            $academicFormation->senescyt_code = null;
        }

        $academicFormation->save();

        return (new AcademicFormationResource($academicFormation))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Professional $professional, AcademicFormation $academicFormation)
    {
        $academicFormation->delete();
        return (new AcademicFormationResource($academicFormation))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysAcademicFormationRequest $request)
    {
        $academicFormations = AcademicFormation::whereIn('id', $request->input('ids'))->get();
        AcademicFormation::destroy($request->input('ids'));

        return (new AcademicFormationCollection($academicFormations))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    /*******************************************************************************************************************
     * FILES
     *******************************************************************************************************************/
    public function indexFiles(IndexFileRequest $request, AcademicFormation $academicFormation)
    {
        return $academicFormation->indexFiles($request);
    }

    public function uploadFile(UploadFileRequest $request, AcademicFormation $academicFormation)
    {
        return $academicFormation->uploadFile($request);
    }

    public function downloadFile(AcademicFormation $academicFormation, File $file)
    {
        return $academicFormation->downloadFile($file);
    }

    public function showFile(AcademicFormation $academicFormation, File $file)
    {
        return $academicFormation->showFile($file);
    }

    public function updateFile(UpdateFileRequest $request, AcademicFormation $academicFormation, File $file)
    {
        return $academicFormation->updateFile($request, $file);
    }

    public function destroyFile(AcademicFormation $academicFormation, File $file)
    {
        return $academicFormation->destroyFile($file);
    }

    public function destroyFiles(AcademicFormation $academicFormation, DestroysFileRequest $request)
    {
        return $academicFormation->destroyFiles($request);
    }
}
