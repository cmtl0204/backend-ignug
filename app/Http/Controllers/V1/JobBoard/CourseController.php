<?php

namespace App\Http\Controllers\V1\JobBoard;

// Controllers
use App\Http\Controllers\Controller;

// Models
use App\Http\Requests\V1\Core\Files\DestroysFileRequest;
use App\Http\Requests\V1\JobBoard\Course\DestroysCourseRequest;
use App\Http\Resources\V1\JobBoard\CourseCollection;
use App\Http\Resources\V1\JobBoard\CourseResource;
use App\Models\Core\Catalogue;
use App\Models\Core\File;
use App\Models\JobBoard\AcademicFormation;
use App\Models\JobBoard\Professional;
use App\Models\JobBoard\Course;

// FormRequest
use App\Http\Requests\V1\JobBoard\Course\IndexCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\CreateCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\UpdateCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\StoreCourseRequest;
use App\Http\Requests\V1\JobBoard\Course\DeleteCourseRequest;

use App\Http\Controllers\V1\Core\FileController;
use App\Http\Requests\V1\Core\Files\UpdateFileRequest;
use App\Http\Requests\V1\Core\Files\UploadFileRequest;
use App\Http\Requests\V1\Core\Files\IndexFileRequest;

use Illuminate\Support\Facades\Request;

class CourseController extends Controller
{
    function index(IndexCourseRequest $request, Professional $professional)
    {
        $sorts = explode(',', $request->sort);

        $courses = $professional->courses()
            ->customOrderBy($sorts)
            ->description($request->input('description'))
            ->name($request->input('name'))
            ->paginate($request->perPage);

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
        $institution = Catalogue::find($request->input('institution.id'));
        $certification_type = Catalogue::find($request->input('certification_type.id'));
        $area = Catalogue::find($request->input('area.id'));

        $course = new Course();
        $course->professional()->associate($professional);
        $course->institution()->associate($institution);
        $course->type()->associate($type);
        $course->certification_type()->associate($certification_type);
        $course->area()->associate($area);

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->start_date = $request->input('start_date');
        $course->end_date = $request->input('end_date');
        $course->hours = $request->input('hours');

        $course->save();

        rreturn (new CourseResource($course))
            ->additional([
                'msg' => [
                    'summary' => 'Registro Creado',
                    'detail' => '',
                    'code' => '200'
                ]
            ]);
    }

    function show(Course $course)
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

    function update(UpdateCourseRequest $request, Course $course)
    {
        $type = Catalogue::find($request->input('type.id'));
        $institution = Catalogue::find($request->input('institution.id'));
        $certification_type = Catalogue::find($request->input('certification_type.id'));
        $area = Catalogue::find($request->input('area.id'));

        $course->institution()->associate($institution);
        $course->type()->associate($type);
        $course->certification_type()->associate($certification_type);
        $course->area()->associate($area);

        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->start_date = $request->input('startDate');
        $course->end_date = $request->input('endDate');
        $course->hours = $request->input('hours');
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

    public function destroy(Course $course)
    {
        $course->delete();
        return (new AcademicFormationResource($course))
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

        return (new CourseResource($courses))
            ->additional([
                'msg' => [
                    'summary' => 'Registros Eliminados',
                    'detail' => '',
                    'code' => '201'
                ]
            ]);
    }
    /***********************************************************************************************************************
     * FILES
     **********************************************************************************************************************/
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


