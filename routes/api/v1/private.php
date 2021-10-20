<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Core\UserController;
use App\Http\Controllers\V1\Core\FileController;
use App\Http\Controllers\V1\Core\CatalogueController;
use App\Http\Controllers\V1\Uic\EnrollmentController;
use App\Http\Controllers\V1\Uic\EventController;
use App\Http\Controllers\V1\Uic\MeshStudentController;
use App\Http\Controllers\V1\Uic\MeshStudentRequirementController;
use App\Http\Controllers\V1\Uic\ModalityController;
use App\Http\Controllers\V1\Uic\PlanningController;
use App\Http\Controllers\V1\Uic\ProjectController;
use App\Http\Controllers\V1\Uic\ProjectPlanController;
use App\Http\Controllers\V1\Uic\RequirementController;
use App\Http\Controllers\V1\Uic\RequirementRequestController;
use App\Http\Controllers\V1\Uic\StudentController;
use App\Http\Controllers\V1\Uic\StudentInformationController;
use App\Http\Controllers\V1\Uic\TutorController;
use App\Http\Controllers\V1\Uic\TutorShipController;

/***********************************************************************************************************************
 * CATALOGUES
 **********************************************************************************************************************/
Route::apiResource('catalogues', CatalogueController::class);

/***********************************************************************************************************************
 * USERS
 **********************************************************************************************************************/
Route::apiResource('users', UserController::class);

Route::prefix('user')->group(function () {
    Route::patch('destroys', [UserController::class, 'destroys']);
});

Route::prefix('user/{user}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [UserController::class, 'downloadFile']);
        Route::get('', [UserController::class, 'indexFiles']);
        Route::get('{file}', [UserController::class, 'showFile']);
        Route::post('', [UserController::class, 'uploadFile']);
        Route::put('{file}', [UserController::class, 'updateFile']);
        Route::delete('{file}', [UserController::class, 'destroyFile']);
        Route::patch('', [UserController::class, 'destroyFiles']);
    });
    Route::prefix('image')->group(function () {
        Route::get('{image}/download', [UserController::class, 'downloadImage']);
        Route::get('', [UserController::class, 'indexImages']);
        Route::get('{image}', [UserController::class, 'showImage']);
        Route::post('', [UserController::class, 'uploadImage']);
        Route::put('{image}', [UserController::class, 'updateImage']);
        Route::delete('{image}', [UserController::class, 'destroyImage']);
        Route::patch('', [UserController::class, 'destroyImages']);
    });
});

/***********************************************************************************************************************
 * FILES
* **********************************************************************************************************************/
Route::apiResource('files', FileController::class)->except(['index', 'store']);

Route::prefix('file')->group(function () {
    Route::patch('destroys', [FileController::class, 'destroys']);
});

Route::prefix('file/{file}')->group(function () {
    Route::get('download', [FileController::class, 'download']);
});

/***********************************************************************************************************************
 * ENROLLMENTS
 **********************************************************************************************************************/
Route::apiResource('enrollments', EnrollmentController::class);

Route::prefix('enrollment')->group(function () {
    Route::patch('destroys', [EnrollmentController::class, 'destroys']);
});

Route::prefix('enrollment/{enrollment}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * EVENTS
 **********************************************************************************************************************/
Route::apiResource('events', EventController::class);

Route::prefix('event')->group(function () {
    Route::patch('destroys', [EventController::class, 'destroys']);
});

Route::prefix('event/{event}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * MESHS-TUDENTS
 **********************************************************************************************************************/
Route::apiResource('mesh-students', MeshStudentController::class);

Route::prefix('mesh-student')->group(function () {
    Route::patch('destroys', [MeshStudentController::class, 'destroys']);
});

Route::prefix('mesh-students/{mesh-students}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * MESHSTUDENTREQUIREMENTS
 **********************************************************************************************************************/
Route::apiResource('mesh-student-requirements', MeshStudentRequirementController::class);

Route::prefix('mesh-student-requirement')->group(function () {
    Route::patch('destroys', [MeshStudentRequirementController::class, 'destroys']);
});

Route::prefix('meshstudentrequirement/{meshstudentrequirement}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * MODALITYS
 **********************************************************************************************************************/
Route::apiResource('modalitys', ModalityController::class);

Route::prefix('modality')->group(function () {
    Route::patch('destroys', [ModalityController::class, 'destroys']);
});

Route::prefix('modality/{modality}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * PLANNINGS
 **********************************************************************************************************************/
Route::apiResource('plannings', PlanningController::class);

Route::prefix('planning')->group(function () {
    Route::patch('destroys', [PlanningController::class, 'destroys']);
});

Route::prefix('planning/{planning}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * PROJECTS
 **********************************************************************************************************************/
Route::apiResource('projects', ProjectController::class);

Route::prefix('project')->group(function () {
    Route::patch('destroys', [ProjectController::class, 'destroys']);
});

Route::prefix('project/{project}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * PROJECTPLANS
 **********************************************************************************************************************/
Route::apiResource('projectplans', ProjectPlanController::class);

Route::prefix('projectplan')->group(function () {
    Route::patch('destroys', [ProjectPlanController::class, 'destroys']);
});

Route::prefix('projectplan/{projectplan}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * REQUIREMENTS
 **********************************************************************************************************************/
Route::apiResource('requirements', RequirementController::class);

Route::prefix('requirement')->group(function () {
    Route::patch('destroys', [RequirementController::class, 'destroys']);
});

Route::prefix('requirement/{requirement}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * REQUIREMENTREQUESTS
 **********************************************************************************************************************/
Route::apiResource('requirementrequests', RequirementRequestController::class);

Route::prefix('requirementrequest')->group(function () {
    Route::patch('destroys', [RequirementRequestController::class, 'destroys']);
});

Route::prefix('requirementrequest/{requirementrequest}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * STUDENTS
 **********************************************************************************************************************/
Route::apiResource('students', StudentController::class);

Route::prefix('student')->group(function () {
    Route::patch('destroys', [StudentController::class, 'destroys']);
});

Route::prefix('student/{student}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * STUDENTINFORMATIONS
 **********************************************************************************************************************/
Route::apiResource('studentinformations', StudentInformationController::class);

Route::prefix('studentinformation')->group(function () {
    Route::patch('destroys', [StudentInformationController::class, 'destroys']);
});

Route::prefix('studentinformation/{studentinformation}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * TUTORS
 **********************************************************************************************************************/
Route::apiResource('tutors', TutorController::class);

Route::prefix('tutor')->group(function () {
    Route::patch('destroys', [TutorController::class, 'destroys']);
});

Route::prefix('tutor/{tutor}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});

/***********************************************************************************************************************
 * TUTORSHIPS
 **********************************************************************************************************************/
Route::apiResource('tutorships', TutorShipController::class);

Route::prefix('tutorship')->group(function () {
    Route::patch('destroys', [TutorShipController::class, 'destroys']);
});

Route::prefix('tutorship/{tutorship}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});