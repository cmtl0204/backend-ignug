<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\V1\LicenseWork\ApplicationController;
use App\Http\Controllers\V1\LicenseWork\StateController;



/***********************************************************************************************************************
 * Route license Work
<<<<<<< HEAD
 **********************************************************************************************************************/
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
