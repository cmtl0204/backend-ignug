<?php

namespace App\Http\Controllers\V1\JobBoard;

// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Http\Requests\V1\Core\Files\DestroysFileRequest;
use App\Http\Requests\V1\Core\Files\IndexFileRequest;
use App\Http\Requests\V1\Core\Files\UpdateFileRequest;
use App\Http\Requests\V1\Core\Files\UploadFileRequest;
use App\Models\Core\Catalogue;
use App\Models\Core\File;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Language;

// Resources
use App\Http\Resources\V1\JobBoard\LanguageCollection;
use App\Http\Resources\V1\JobBoard\LanguageResource;

// FormRequest
use App\Http\Requests\V1\JobBoard\Language\IndexLanguageRequest;
use App\Http\Requests\V1\JobBoard\Language\UpdateLanguageRequest;
use App\Http\Requests\V1\JobBoard\Language\StoreLanguageRequest;
use App\Http\Requests\V1\JobBoard\Language\DestroysLanguageRequest;


use Illuminate\Database\Eloquent\Model;

class LanguageController extends Controller
{
    function index(IndexLanguageRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $languages = $professional->languages()
            ->customOrderBy($sorts)
            ->paginate($request->per_page);

        return (new LanguageCollection($languages))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Professional $professional, Language $language)
    {
        return (new LanguageResource($language))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function store(StoreLanguageRequest $request, Professional $professional)
    {
        $idiom = Catalogue::find($request->input('idiom.id'));
        $writtenLevel = Catalogue::find($request->input('writtenLevel.id'));
        $spokenLevel = Catalogue::find($request->input('spokenLevel.id'));
        $readLevel = Catalogue::find($request->input('readLevel.id'));

        $language = new Language();
        $language->professional()->associate($professional);
        $language->idiom()->associate($idiom);
        $language->writtenLevel()->associate($writtenLevel);
        $language->spokenLevel()->associate($spokenLevel);
        $language->readLevel()->associate($readLevel);
        $language->save();

        return (new LanguageResource($language))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function update(UpdateLanguageRequest $request, Professional $professional, Language $language)
    {
        $idiom = Catalogue::find($request->input('idiom.id'));
        $writtenLevel = Catalogue::find($request->input('writtenLevel.id'));
        $spokenLevel = Catalogue::find($request->input('spokenLevel.id'));
        $readLevel = Catalogue::find($request->input('readLevel.id'));

        $language->idiom()->associate($idiom);
        $language->writtenLevel()->associate($writtenLevel);
        $language->spokenLevel()->associate($spokenLevel);
        $language->readLevel()->associate($readLevel);
        $language->save();

        return (new LanguageResource($language))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Professional $professional, Language $language)
    {
        $language->delete();
        return (new LanguageResource($language))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysLanguageRequest $request)
    {
        $languages = Language::whereIn('id', $request->input('ids'))->get();
        Language::destroy($request->input('ids'));

        return (new LanguageCollection($languages))
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
    public function indexFiles(IndexFileRequest $request, Language $language)
    {
        return $language->indexFiles($request);
    }

    public function uploadFile(UploadFileRequest $request, Language $language)
    {
        return $language->uploadFile($request);
    }

    public function downloadFile(Language $language, File $file)
    {
        return $language->downloadFile($file);
    }

    public function showFile(Language $language, File $file)
    {
        return $language->showFile($file);
    }

    public function updateFile(UpdateFileRequest $request, Language $language, File $file)
    {
        return $language->updateFile($request, $file);
    }

    public function destroyFile(Language $language, File $file)
    {
        return $language->destroyFile($file);
    }

    public function destroyFiles(Language $language, DestroysFileRequest $request)
    {
        return $language->destroyFiles($request);
    }

}

