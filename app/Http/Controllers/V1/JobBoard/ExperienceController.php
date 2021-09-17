<?php

namespace App\Http\Controllers\V1\JobBoard;
// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Models\JobBoard\Professional;
use App\Models\App\Core\Catalogue;
use App\Models\JobBoard\Experience;

// Resources
use App\Http\Resources\V1\JobBoard\ExperienceCollection;
use App\Http\Resources\V1\JobBoard\ExperienceResource;

// FormRequest
use App\Http\Requests\JobBoard\Experience\DeleteExperienceRequest;
use App\Http\Requests\JobBoard\Experience\StoreExperienceRequest;
use App\Http\Requests\JobBoard\Experience\UpdateExperienceRequest;
use App\Http\Requests\JobBoard\Experience\IndexExperienceRequest;
use App\Http\Requests\JobBoard\Experience\DestroysExperienceRequest;

use App\Http\Controllers\App\FileController;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\App\File\IndexFileRequest;

class ExperienceController extends Controller
{
    // Muestra los datos del profesional con experiencia
    function index(IndexExperienceRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $experiences = $professional->experiences()
            ->customOrderBy($sorts)
            // ->senescytCode($request->input('name'))
            ->paginate($request->per_page);

        return (new ExperienceCollection($experiences))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Experience $experience)
    {
        return (new ExperienceResource($experience))
        ->additional([
            'msg' => [
                'summary' => 'success',
                'detail' => '',
                'code' => '200'
            ]
        ]);
    }

    function store(StoreExperienceRequest $request, Professional $professional)
    {
        $area = Catalogue::find($request->input('areaId'));
        $experience = new Experience();
        $experience->employer = $request->input('employer');
        $experience->position = $request->input('position');
        $experience->start_date = $request->input('startDate');
        $experience->end_date = $request->input('endDate');
        $experience->activities = $request->input('activities');
        $experience->reason_leave = $request->input('reasonLeave');
        $experience->is_working = $request->input('isWorking');
        $experience->is_disability = $request->input('isDisability');
        $experience->professional()->associate($professional);
        $experience->area()->associate($area);
        $experience->save();

        return (new ExperienceResource($experience))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function update(UpdateExperienceRequest $request, Professional $professional,Experience $experience)
    {
        $area = Catalogue::find($request->input('areaId'));
        $experience->employer = $request->input('employer');
        $experience->position = $request->input('position');
        $experience->start_date = $request->input('startDate');
        $experience->end_date = $request->input('endDate');
        $experience->activities = $request->input('activities');
        $experience->reason_leave = $request->input('reasonLeave');
        $experience->is_working = $request->input('isWorking');
        $experience->is_disability = $request->input('isDisability');
        $experience->area()->associate($area);
        $experience->save();

        return (new ExperienceResource($experience))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function delete(Professional $professional,Experience $experience)
    {
        $experience->delete();
        return (new ExperienceResource($experience))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    public function destroys(DestroysExperienceRequest $request)
    {
        $experiences = Experience::whereIn('id', $request->input('ids'))->get();
        Experience::destroy($request->input('ids'));

        return (new ExperienceCollection($experiences))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    function uploadFiles(UploadFileRequest $request)
    {
        return (new FileController())->upload($request, Experience::getInstance($request->input('id')));
    }

    function deleteFile($fileId)
    {
        return (new FileController())->delete($fileId);
    }

    function indexFile(IndexFileRequest $request)
    {
        return (new FileController())->index($request, Experience::getInstance($request->input('id')));
    }

    function ShowFile($fileId)
    {
        return (new FileController())->show($fileId);
    }
}
