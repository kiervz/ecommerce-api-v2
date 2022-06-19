<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Auth\VerificationController;
use App\Http\Controllers\API\V1\BrandController;
use App\Http\Controllers\API\V1\CategoryController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\SegmentController;
use App\Http\Controllers\API\V1\SubCategoryController;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/email/verification', [VerificationController::class, 'sendVerificationEmail'])->name('verification.email');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

    Route::post('/v1/auth/logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::get('/v1/auth/me', function (Request $request) {
        return new UserResource($request->user());
    });
});

Route::post('/v1/auth/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/v1/auth/login', [LoginController::class, 'login'])->name('auth.login');

Route::group(['prefix' => 'v1'], function() {
    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::apiResource('segment', SegmentController::class);
        Route::get('segment/{segment}/categories', [SegmentController::class, 'getCategoriesBySegment'])->name('segment.getCategoriesBySegment');
        Route::apiResource('category', CategoryController::class);
        Route::get('category/{category}/sub-categories', [CategoryController::class, 'getSubCategoriesByCategory'])->name('category.getSubCategoriesByCategory');
        Route::apiResource('sub-category', SubCategoryController::class);
        Route::apiResource('brand', BrandController::class);
        Route::apiResource('product', ProductController::class);
    });
});
