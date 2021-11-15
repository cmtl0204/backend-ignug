<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\App\FileController;
use App\Http\Controllers\App\ImageController;
use App\Http\Requests\JobBoard\Skill\DeleteSkillRequest;
use App\Models\Core\Catalogue;
use App\Models\JobBoard\Skill;
use App\Http\Requests\V1\JobBoard\Skill\StoreInstitutionRequest;
use App\Http\Requests\V1\JobBoard\Skill\IndexInstitutionRequest;
use App\Http\Requests\V1\JobBoard\Skill\UpdateInstitutionRequest;
use App\Http\Requests\V1\JobBoard\Skill\DestroysSkillRequest;
use App\Http\Requests\App\Image\UpdateImageRequest;
use App\Http\Requests\App\Image\UploadImageRequest;
use App\Http\Requests\App\File\UpdateFileRequest;
use App\Http\Requests\App\File\UploadFileRequest;
use App\Http\Requests\App\File\IndexFileRequest;
use App\Http\Requests\App\Image\IndexImageRequest;

use App\Models\JobBoard\Professional;

// Resources
use App\Http\Resources\V1\JobBoard\SkillCollection;
use App\Http\Resources\V1\JobBoard\SkillResource;

class SkillController extends Controller
{
    function index(IndexInstitutionRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $skills = $professional->skills()
            ->customOrderBy($sorts)
            ->description($request->input('description'))
            ->paginate($request->per_page);

        return (new SkillCollection($skills))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Professional $professional,Skill $skill)
    {
        return (new SkillResource($skill))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function store(StoreInstitutionRequest $request, Professional $professional)
    {
        $type = Catalogue::find($request->input('type.id'));
        $skill = new Skill();
        $skill->professional()->associate($professional);
        $skill->type()->associate($type);
        $skill->description = $request->input('description');
        $skill->save();

        return (new SkillResource($skill))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function update(UpdateInstitutionRequest $request, Professional $professional, Skill $skill)
    {
        $type = Catalogue::find($request->input('type.id'));
        $skill->type()->associate($type);
        $skill->description = $request->input('description');
        $skill->save();

        return (new SkillResource($skill))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Professional $professional, Skill $skill)
    {
        $skill->delete();
        return (new SkillResource($skill))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysSkillRequest $request)
    {
        $skills = Skill::whereIn('id', $request->input('ids'))->get();
        Skill::destroy($request->input('ids'));

        return (new SkillCollection($skills))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    function uploadImages(UploadImageRequest $request)
    {
        return (new ImageController())->upload($request, Skill::getInstance($request->input('id')));
    }

    function deleteImage($imageId)
    {
        return (new ImageController())->delete($imageId);
    }

    function indexImage(IndexImageRequest $request)
    {
        return (new FileController())->index($request, Skill::getInstance($request->input('id')));
    }

    function ShowImage($fileId)
    {
        return (new FileController())->show($fileId);
    }

    function uploadFiles(UploadFileRequest $request)
    {
        return (new FileController())->upload($request, Skill::getInstance($request->input('id')));
    }

    function deleteFile($fileId)
    {
        return (new FileController())->delete($fileId);
    }

    function indexFile(IndexFileRequest $request)
    {
        return (new FileController())->index($request, Skill::getInstance($request->input('id')));
    }

    function ShowFile($fileId)
    {
        return (new FileController())->show($fileId);
    }
}
