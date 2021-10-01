<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\V1\Core\UserController;
use App\Http\Controllers\V1\Core\FileController;
use App\Http\Controllers\V1\Core\CatalogueController;
use App\Http\Controllers\V1\Core\ReasonController;
use App\Http\Controllers\V1\Core\EmployeeController;


/***********************************************************************************************************************
 * Route license Work REASON
<<<<<<< HEAD
 **********************************************************************************************************************/

Route::apiResource('reasons', ReasonController::class);

Route::prefix('reason')->group(function () {
    Route::patch('destroys', [ReasonController::class, 'destroys']);
});

Route::prefix('reason/{reason}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [ReasonController::class, 'indexFiles']);
        Route::get('{file}', [ReasonController::class, 'showFile']);
        Route::post('', [ReasonController::class, 'uploadFile']);
        Route::put('{file}', [ReasonController::class, 'updateFile']);
        Route::delete('{file}', [ReasonController::class, 'destroyFile']);
        Route::patch('', [ReasonController::class, 'destroyFiles']);
    });
});
=======

use App\Http\Controllers\V1\LicenseWork\ApplicationController;
use App\Http\Controllers\V1\LicenseWork\StateController;
>>>>>>> 2b3e31c815d55f26e59fad552db72e0989172476



/***********************************************************************************************************************
 * Route license Work EMPLOYEE
<<<<<<< HEAD
 **********************************************************************************************************************/
<<<<<<< HEAD
<<<<<<< HEAD
/***********************************************************************************************************************
 * ROUTE FORM
 **********************************************************************************************************************/
Route::apiResource('forms', FormController::class);

Route::prefix('form')->group(function () {
    Route::patch('destroys', [FormController::class, 'destroys']);
});

Route::prefix('academic-formation/{academic_formation}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [FormController::class, 'downloadFile']);
        Route::get('', [FormController::class, 'indexFiles']);
        Route::get('{file}', [FormController::class, 'showFile']);
        Route::post('', [FormController::class, 'uploadFile']);
        Route::put('{file}', [FormController::class, 'updateFile']);
        Route::delete('{file}', [FormController::class, 'destroyFile']);
        Route::patch('', [FormController::class, 'destroyFiles']);
    });
});
/***********************************************************************************************************************
 * ROUTE HOLIDAY
 **********************************************************************************************************************/
Route::apiResource('holidays', HolidayController::class);

Route::prefix('holiday')->group(function () {
    Route::patch('destroys', [HolidayController::class, 'destroys']);
});

Route::prefix('academic-formation/{academic_formation}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [HolidayController::class, 'downloadFile']);
        Route::get('', [HolidayController::class, 'indexFiles']);
        Route::get('{file}', [HolidayController::class, 'showFile']);
        Route::post('', [HolidayController::class, 'uploadFile']);
        Route::put('{file}', [HolidayController::class, 'updateFile']);
        Route::delete('{file}', [HolidayController::class, 'destroyFile']);
        Route::patch('', [HolidayController::class, 'destroyFiles']);
    });
});
/***********************************************************************************************************************
 * ROUTE EMPLOYER
 **********************************************************************************************************************/
Route::apiResource('employers', EmployerController::class);

Route::prefix('employer')->group(function () {
    Route::patch('destroys', [EmployerController::class, 'destroys']);
});

Route::prefix('academic-formation/{academic_formation}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [EmployerController::class, 'downloadFile']);
        Route::get('', [EmployerController::class, 'indexFiles']);
        Route::get('{file}', [EmployerController::class, 'showFile']);
        Route::post('', [EmployerController::class, 'uploadFile']);
        Route::put('{file}', [EmployerController::class, 'updateFile']);
        Route::delete('{file}', [EmployerController::class, 'destroyFile']);
        Route::patch('', [EmployerController::class, 'destroyFiles']);
=======
Route::apiResource('employees', EmployeeController::class);

Route::prefix('employee')->group(function () {
    Route::patch('destroys', [ReasonController::class, 'destroys']);
});

Route::prefix('employee/{employee}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [EmployeeController::class, 'indexFiles']);
        Route::get('{file}', [EmployeeController::class, 'showFile']);
        Route::post('', [EmployeeController::class, 'uploadFile']);
        Route::put('{file}', [EmployeeController::class, 'updateFile']);
        Route::delete('{file}', [EmployeeController::class, 'destroyFile']);
        Route::patch('', [EmployeeController::class, 'destroyFiles']);
>>>>>>> 44fadb2057ff871275d91ac03d0fe7856b10df91
    });
});
=======


/***********************************************************************************************************************
 * Route Application
 **********************************************************************************************************************/

Route::apiResource('applications', ApplicationController::class);


Route::prefix('application')->group(function () {
    Route::patch('destroys', [ApplicationController::class, 'destroys']);
});

Route::prefix('application/{application}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [ApplicationController::class, 'downloadFile']);
        Route::get('', [ApplicationController::class, 'indexFiles']);
        Route::get('{file}', [ApplicationController::class, 'showFile']);
        Route::post('', [ApplicationController::class, 'uploadFile']);
        Route::put('{file}', [ApplicationController::class, 'updateFile']);
        Route::delete('{file}', [ApplicationController::class, 'destroyFile']);
        Route::patch('', [ApplicationController::class, 'destroyFiles']);
    });
});

/***********************************************************************************************************************
 * Route State
 **********************************************************************************************************************/

Route::apiResource('states',StateController ::class);


Route::prefix('state')->group(function () {
    Route::patch('destroys', [StateController::class, 'destroys']);
});

Route::prefix('state/{state}')->group(function () {
});
>>>>>>> 2b3e31c815d55f26e59fad552db72e0989172476
