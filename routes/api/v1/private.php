<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Core\UserController;
use App\Http\Controllers\V1\Core\FileController;
use App\Http\Controllers\V1\Core\CatalogueController;
use App\Http\Controllers\V1\Uic\EnrollmentController;

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
Route::apiResource('enrollments', EnrollmentController::class);

Route::prefix('enrollment')->group(function () {
    Route::patch('destroys', [EnrollmentController::class, 'destroys']);
});

Route::prefix('enrollment/{enrollment}')->group(function () {
    Route::prefix('file')->group(function () {
    });
});