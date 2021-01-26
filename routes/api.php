<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\Services\ServiceController;
use App\Http\Controllers\API\ClientJobs\ClientJobController;
use App\Http\Controllers\API\ClientJobs\ClientJobImageController;
use App\Http\Controllers\API\ClientAddresses\ClientAddressController;

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

Route::post('register', [RegistrationController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user()->load('permissions');
});

Route::prefix('services')->middleware('auth:api')->group(function() {
    Route::get('/', [ServiceController::class, 'index']);
    Route::get('/search', [ServiceController::class, 'search']);
});

Route::prefix('addresses')->middleware('auth:api')->group(function () {
    Route::get('/', [ClientAddressController::class, 'index'])->middleware('userIdBelongsToAuthenticatedUser');
    Route::get('{address}', [ClientAddressController::class, 'show']);
    Route::post('/', [ClientAddressController::class, 'store'])->middleware('userIdBelongsToAuthenticatedUser');
    Route::put('{address}', [ClientAddressController::class, 'update']);
    Route::delete('{address}', [ClientAddressController::class, 'destroy'])->middleware('addressBelongsToUser');
});

// Could use a resource route here instead
Route::prefix('jobs')->middleware('auth:api')->group(function () {
    Route::get('/', [ClientJobController::class, 'index']); //middleware in constructor
    Route::get('{job}', [ClientJobController::class, 'show']); //middleware in constructor
    Route::post('/', [ClientJobController::class, 'store'])->middleware('userIdBelongsToAuthenticatedUser');
    Route::put('{job}', [ClientJobController::class, 'update']);
    Route::delete('{job}', [ClientJobController::class, 'destroy']);

    Route::get('{job}/images', [ClientJobImageController::class, 'index']);
    Route::post('{job}/images', [ClientJobImageController::class, 'store']);
    Route::delete('{job}/images/{image}', [ClientJobImageController::class, 'destroy']);
});
