<?php

use App\Http\Controllers\Api\Admin\AdminPageController;
use App\Http\Controllers\Api\Admin\AdminProjectController;
use App\Http\Controllers\Api\Admin\MediaUploadController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PublicPageController;
use App\Http\Controllers\Api\PublicProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - V1
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Public Routes for Portfolio Showcase & Guest Users
    Route::get('/projects', [PublicProjectController::class, 'index']);
    Route::get('/projects/{slug}', [PublicProjectController::class, 'show']);
    Route::get('/tech-stacks', [PublicProjectController::class, 'techStacks']);
    Route::get('/pages', [PublicPageController::class, 'index']);
    Route::get('/pages/{slug}', [PublicPageController::class, 'show']);

    // Admin Auth Routes
    Route::post('/auth/login', [AuthController::class, 'login']);

    // Protected Admin CMS Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);

        Route::prefix('admin')->group(function () {
            Route::get('/projects', [AdminProjectController::class, 'index']);
            Route::post('/projects', [AdminProjectController::class, 'store']);
            Route::put('/projects/{id}', [AdminProjectController::class, 'update']);
            Route::delete('/projects/{id}', [AdminProjectController::class, 'destroy']);
            Route::patch('/projects/{id}/featured', [AdminProjectController::class, 'toggleFeatured']);
            Route::post('/upload', [MediaUploadController::class, 'upload']);

            Route::get('/pages', [AdminPageController::class, 'index']);
            Route::post('/pages', [AdminPageController::class, 'store']);
            Route::get('/pages/{id}', [AdminPageController::class, 'show']);
            Route::put('/pages/{id}', [AdminPageController::class, 'update']);
            Route::delete('/pages/{id}', [AdminPageController::class, 'destroy']);
            Route::patch('/pages/{id}/toggle-menu', [AdminPageController::class, 'toggleMenu']);
        });
    });
});
