<?php

namespace App\Http\Controllers\V1\JobBoard;
// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Models\JobBoard\Professional;
use App\Models\Core\Catalogue;
use App\Models\JobBoard\Experience;

// Resources
use App\Http\Resources\V1\JobBoard\ExperienceCollection;
use App\Http\Resources\V1\JobBoard\ExperienceResource;

// FormRequest
use App\Http\Requests\V1\JobBoard\Experience\DeleteExperienceRequest;
use App\Http\Requests\V1\JobBoard\Experience\StoreExperienceRequest;
use App\Http\Requests\V1\JobBoard\Experience\UpdateExperienceRequest;
use App\Http\Requests\V1\JobBoard\Experience\IndexExperienceRequest;
use App\Http\Requests\V1\JobBoard\Experience\DestroysExperienceRequest;

use App\Http\Controllers\App\FileController;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\App\File\IndexFileRequest;

class ExperienceController extends Controller
{
    public function index(IndexExperienceRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $experiences = $professional->experiences()
            ->customOrderBy($sorts)
            ->employer($request->input('employer'))
            ->position($request->input('position'))
            ->reasonLeave($request->input('reasonLeave'))
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

    public function show(Professional $professional, Experience $experience)
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

    public function store(StoreExperienceRequest $request, Professional $professional)
    {
        $area = Catalogue::find($request->input('area.id'));
        $experience = new Experience();
        $experience->professional()->associate($professional);
        $experience->area()->associate($area);
        $experience->employer = $request->input('employer');
        $experience->position = $request->input('position');
        $experience->started_at = $request->input('startedAt');
        $experience->ended_at = $request->input('endedAt');
        $experience->activities = $request->input('activities');
        $experience->reason_leave = $request->input('reasonLeave');
        $experience->worked = $request->input('worked');
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

    public function update(UpdateExperienceRequest $request, Professional $professional, Experience $experience)
    {
        $area = Catalogue::find($request->input('area.id'));
        $experience->employer = $request->input('employer');
        $experience->position = $request->input('position');
        $experience->started_at = $request->input('startedAt');
        $experience->activities = $request->input('activities');
        $experience->worked = $request->input('worked');

        if ($request->input('worked')) {
            $experience->ended_at = $request->input('endedAt');
            $experience->reason_leave = $request->input('reasonLeave');
        } else {
            $experience->ended_at = null;
            $experience->reason_leave = null;
        }

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

    public function destroy(Professional $professional, Experience $experience)
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

    // function uploadFiles(UploadFileRequest $request)
    // {
    //     return (new FileController())->upload($request, Experience::getInstance($request->input('id')));
    // }

    // function deleteFile($fileId)
    // {
    //     return (new FileController())->delete($fileId);
    // }

    // function indexFile(IndexFileRequest $request)
    // {
    //     return (new FileController())->index($request, Experience::getInstance($request->input('id')));
    // }

    // function ShowFile($fileId)
    // {
    //     return (new FileController())->show($fileId);
    // }
    /*******************************************************************************************************************
     * FILES
     *******************************************************************************************************************/
    // public function indexFiles(Experience $request, Experience $experience)
    // {
    //     return $experience->indexFiles($request);
    // }

    // public function uploadFile(UploadFileRequest $request, Experience $experience)
    // {
    //     return $experience->uploadFile($request);
    // }

    // public function downloadFile(Experience $experience, File $file)
    // {
    //     return $experience->downloadFile($file);
    // }

    // public function showFile(Experience $experience, File $file)
    // {
    //     return $experience->showFile($file);
    // }

    // public function updateFile(UpdateFileRequest $request, Experience $experience, File $file)
    // {
    //     return $experience->updateFile($request, $file);
    // }

    // public function destroyFile(Experience $experience, File $file)
    // {
    //     return $experience->destroyFile($file);
    // }

    // public function destroyFiles(Experience $experience, DestroysFileRequest $request)
    // {
    //     return $experience->destroyFiles($request);
    // }
}
