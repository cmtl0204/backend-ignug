<?php

namespace App\Http\Controllers\V1\JobBoard;

// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Models\App\Catalogue;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Language;

// Resources
use App\Http\Resources\V1\JobBoard\LanguageCollection;
use App\Http\Resources\V1\JobBoard\LanguageResource;

// FormRequest

use App\Http\Requests\JobBoard\Language\IndexLanguageRequest;
use App\Http\Requests\JobBoard\Language\UpdateLanguageRequest;
use App\Http\Requests\JobBoard\Language\CreateLanguageRequest;
use App\Http\Requests\JobBoard\Language\StoreLanguageRequest;
use App\Http\Requests\JobBoard\Language\DeleteLanguageRequest;
use App\Http\Requests\JobBoard\Language\DestroysLanguagesRequest;
use App\Http\Controllers\App\FileController;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\App\File\IndexFileRequest;

use Illuminate\Database\Eloquent\Model;

class LanguageController extends Controller
{
    function index(IndexLanguageRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $languages = $professional->languages()
            ->customOrderBy($sorts)
            // ->senescytCode($request->input('name'))
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

    function show(Language $language)
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
        $idiom = Catalogue::find($request->input('idiomId'));
        $written_level = Catalogue::find($request->input('writtenLevelId'));
        $spoken_level = Catalogue::find($request->input('spokenLevelId'));
        $read_level = Catalogue::find($request->input('readLevelId'));

        $language = new Language();
        $language->professional()->associate($professional);
        $language->idiom()->associate($idiom);
        $language->written_level()->associate($written_level);
        $language->spoken_level()->associate($spoken_level);
        $language->read_level()->associate($read_level);
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

    function update(UpdateLanguageRequest $request, Professional $professional,Language $language)
    {
        $idiom = Catalogue::find($request->input('idiomId'));
        $written_level = Catalogue::find($request->input('writtenLevelId'));
        $spoken_level = Catalogue::find($request->input('spokenLevelId'));
        $read_level = Catalogue::find($request->input('readLevelId'));

        $language->idiom()->associate($idiom);
        $language->written_level()->associate($written_level);
        $language->spoken_level()->associate($spoken_level);
        $language->read_level()->associate($read_level);
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

    public function destroys(DestroysLanguagesRequest $request)
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
    function uploadFiles(UploadFileRequest $request)
    {
        return (new FileController())->upload($request, Language::getInstance($request->input('id')));
    }

    function deleteFile($fileId)
    {
        return (new FileController())->delete($fileId);
    }

    function indexFile(IndexFileRequest $request)
    {
        return (new FileController())->index($request, Language::getInstance($request->input('id')));
    }

    function ShowFile($fileId)
    {
        return (new FileController())->show($fileId);
    }
    /*******************************************************************************************************************
     * FILES
     *******************************************************************************************************************/
    public function indexFiles(IndexFileRequest $request, Language $language)
    {
        return $language->indexFiles($request);
    }

    public function uploadFile(UploadFileRequest $request, Language $languaje)
    {
        return $languaje->uploadFile($request);
    }

    public function downloadFile(Language $languaje, File $file)
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

    public function destroyFiles(Language $languaje, DestroysFileRequest $request)
    {
        return $language->destroyFiles($request);
    }
}

