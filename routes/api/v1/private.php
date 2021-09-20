<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Core\UserController;
use App\Http\Controllers\V1\Core\FileController;
use App\Http\Controllers\V1\Core\CatalogueController;
use App\Http\Controllers\V1\JobBoard\AcademicFormationController;
use App\Http\Controllers\V1\JobBoard\CourseController;

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
 **********************************************************************************************************************/
Route::apiResource('files', FileController::class)->except(['index', 'store']);

Route::prefix('file')->group(function () {
    Route::patch('destroys', [FileController::class, 'destroys']);
});

Route::prefix('file/{file}')->group(function () {
    Route::get('download', [FileController::class, 'download']);
});

/***********************************************************************************************************************
 * ACADEMIC FORMATIONS
 **********************************************************************************************************************/
Route::apiResource('professionals.academic-formations', AcademicFormationController::class);

Route::prefix('academic-formation')->group(function () {
    Route::patch('destroys', [AcademicFormationController::class, 'destroys']);
});

Route::prefix('academic-formation/{academic_formation}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [AcademicFormationController::class, 'downloadFile']);
        Route::get('', [AcademicFormationController::class, 'indexFiles']);
        Route::get('{file}', [AcademicFormationController::class, 'showFile']);
        Route::post('', [AcademicFormationController::class, 'uploadFile']);
        Route::put('{file}', [AcademicFormationController::class, 'updateFile']);
        Route::delete('{file}', [AcademicFormationController::class, 'destroyFile']);
        Route::patch('', [AcademicFormationController::class, 'destroyFiles']);
    });
});

/***********************************************************************************************************************
 * EXPERIENCE
 **********************************************************************************************************************/
Route::apiResource('professionals.experience', ExperienceController::class);

Route::prefix('experience')->group(function () {
    Route::patch('destroys', [ExperienceController::class, 'destroys']);
});

Route::prefix('experience/{experience}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [ExperienceController::class, 'downloadFile']);
        Route::get('', [ExperienceController::class, 'indexFiles']);
        Route::get('{file}', [ExperienceController::class, 'showFile']);
        Route::post('', [ExperienceController::class, 'uploadFile']);
        Route::put('{file}', [ExperienceController::class, 'updateFile']);
        Route::delete('{file}', [ExperienceController::class, 'destroyFile']);
        Route::patch('', [ExperienceController::class, 'destroyFiles']);
    });
});

/***********************************************************************************************************************
 * COURSES
 **********************************************************************************************************************/
Route::apiResource('professionals.courses', CourseController::class);

Route::prefix('course')->group(function () {
    Route::patch('destroys', [CourseController::class, 'destroys']);
});

Route::prefix('course/{course}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [CourseController::class, 'downloadFile']);
        Route::get('', [CourseController::class, 'indexFiles']);
        Route::get('{file}', [CourseController::class, 'showFile']);
        Route::post('', [CourseController::class, 'uploadFile']);
        Route::put('{file}', [CourseController::class, 'updateFile']);
        Route::delete('{file}', [CourseController::class, 'destroyFile']);
        Route::patch('', [CourseController::class, 'destroyFiles']);
    });
});

/***********************************************************************************************************************
 * LANGUAGE
 **********************************************************************************************************************/
Route::apiResource('professionals.language', LanguageController::class);

Route::prefix('language')->group(function () {
    Route::patch('destroys', [LanguageController::class, 'destroys']);
});

Route::prefix('language/{language}')->group(function () {
    Route::prefix('file')->group(function () {
        Route::get('{file}/download', [LanguageController::class, 'downloadFile']);
        Route::get('', [LanguageController::class, 'indexFiles']);
        Route::get('{file}', [LanguageController::class, 'showFile']);
        Route::post('', [LanguageController::class, 'uploadFile']);
        Route::put('{file}', [LanguageController::class, 'updateFile']);
        Route::delete('{file}', [LanguageController::class, 'destroyFile']);
        Route::patch('', [LanguageController::class, 'destroyFiles']);
    });
});
/***********************************************************************************************************************
 * REFERENCES
 **********************************************************************************************************************/
Route::apiResource('professionals.reference', ReferenceController::class);

Route::prefix('reference')->group(function () {
    Route::patch('destroys', [ReferenceController::class, 'destroys']);
});

Route::prefix('reference/{reference}')->group(function () {
   
});

/***********************************************************************************************************************
 * SKILL
 **********************************************************************************************************************/
Route::apiResource('professionals.skill', SkillController::class);

Route::prefix('skill')->group(function () {
    Route::patch('destroys', [SkillController::class, 'destroys']);
});

Route::prefix('skill/{skill}')->group(function () {
   
});