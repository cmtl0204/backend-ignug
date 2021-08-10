<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\RoleController;
use App\Http\Controllers\V1\PermissionController;

Route::prefix('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('logout-all', [AuthController::class, 'logoutAll']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('unlock-user', [AuthController::class, 'unlockUser']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('generate-transactional-code', [AuthController::class, 'generateTransactionalCode']);
    Route::post('verify-transactional-code', [AuthController::class, 'verifyTransactionalCode']);
});

Route::prefix('role/{role}')->group(function () {
    Route::post('give-permissions', [RoleController::class, 'givePermissions']);
    Route::post('sync-permissions', [RoleController::class, 'syncPermissions']);
    Route::patch('revoke-permissions', [RoleController::class, 'revokePermissions']);
});

Route::prefix('permission/{permission}')->group(function () {
    Route::post('assign-roles', [PermissionController::class, 'assignRoles']);
    Route::post('sync-roles', [PermissionController::class, 'syncRoles']);
    Route::patch('remove-roles', [PermissionController::class, 'removeRoles']);
});
