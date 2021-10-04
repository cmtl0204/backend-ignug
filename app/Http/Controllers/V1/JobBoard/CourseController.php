<?php

namespace App\Http\Controllers\V1\JobBoard;

use App\Http\Controllers\Controller;

// Models
use App\Models\JobBoard\Course;
use App\Models\Core\Catalogue;
use App\Models\Core\File;
use App\Models\JobBoard\Professional;

// Resources
use App\Http\Resources\V1\JobBoard\CourseCollection;
use App\Http\Resources\V1\JobBoard\CourseResource;

// FormRequest
use App\Http\Requests\V1\JobBoard\Course\DestroysCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\IndexCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\UpdateCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\StoreCourseRequest;

use App\Http\Requests\V1\Core\Files\DestroysFileRequest;
use App\Http\Requests\V1\Core\Files\IndexFileRequest;
use App\Http\Requests\V1\Core\Files\UpdateFileRequest;
use App\Http\Requests\V1\Core\Files\UploadFileRequest;

class CourseController extends Controller
{
    function index(IndexCourseRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $courses = $professional->courses()
            ->customOrderBy($sorts)
            ->description($request->input('description'))
            ->name($request->input('name'))
            ->institution($request->input('institution'))
            ->paginate($request->per_page);

        return (new CourseCollection($courses))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function store(StoreCourseRequest $request, Professional $professional)
    {
        $type = Catalogue::find($request->input('type.id'));
        $certificationType = Catalogue::find($request->input('certificationType.id'));
        $area = Catalogue::find($request->input('area.id'));

        $course = new Course();
        $course->professional()->associate($professional);
        $course->type()->associate($type);
        $course->certificationType()->associate($certificationType);
        $course->area()->associate($area);

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->started_at = $request->input('startedAt');
        $course->ended_at = $request->input('endedAt');
        $course->hours = $request->input('hours');
        $course->institution = $request->input('institution');

        $course->save();

        return(new CourseResource($course))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Professional $professional, Course $course)
    {
        return (new CourseResource($course))
            ->additional([
                'msg' => [
                    'summary' => 'success',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function update(UpdateCourseRequest $request, Professional $professional, Course $course)
    {
        $type = Catalogue::find($request->input('type.id'));
        $certificationType = Catalogue::find($request->input('certificationType.id'));
        $area = Catalogue::find($request->input('area.id'));

        $course->type()->associate($type);
        $course->certificationType()->associate($certificationType);
        $course->area()->associate($area);

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->started_at = $request->input('startedAt');
        $course->ended_at = $request->input('endedAt');
        $course->hours = $request->input('hours');
        $course->institution = $request->input('institution');
        $course->save();

        return (new CourseResource($course))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Actualizado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    public function destroy(Professional $professional, Course $course)
    {
        $course->delete();
        return (new CourseResource($course))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Eliminado',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }

    public function destroys(DestroysCourseRequest $request)
    {
        $courses = Course::whereIn('id', $request->input('ids'))->get();
        Course::destroy($request->input('ids'));

        return (new CourseCollection($courses))
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
     ******************************************************************************************************************/
    public function indexFiles(IndexFileRequest $request, Course $course)
    {
        return $course->indexFiles($request);
    }

    public function uploadFile(UploadFileRequest $request, Course $course)
    {
        return $course->uploadFile($request);
    }

    public function downloadFile(Course $course, File $file)
    {
        return $course->downloadFile($file);
    }

    public function showFile(Course $course, File $file)
    {
        return $course->showFile($file);
    }

    public function updateFile(UpdateFileRequest $request, Course $course, File $file)
    {
        return $course->updateFile($request, $file);
    }

    public function destroyFile(Course $course, File $file)
    {
        return $course->destroyFile($file);
    }

    public function destroyFiles(Course $course, DestroysFileRequest $request)
    {
        return $course->destroyFiles($request);
    }
}


