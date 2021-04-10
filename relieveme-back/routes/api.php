<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HazardController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\BlocadeController;
use App\Http\Controllers\CheckpointsController;
use App\Http\Controllers\SuggestionsController;
use App\Http\Controllers\QRCodeGeneratorController;

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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::get('/generateQR', [QRCodeGeneratorController::class, 'generate']);
Route::apiResource('suggestions', SuggestionsController::class);
Route::apiResource('checkpoints', CheckpointsController::class);
Route::post('/checkIn', [CheckController::class, 'checkIn']);
Route::delete('/checkOut', [CheckController::class, 'checkOut']);
Route::apiResource('blocades', BlocadeController::class)->except(['update']);
Route::post('/register', [UserController::class, 'create']);


Route::prefix('/hazards')->group(
    function () {
        Route::get('/', [HazardController::class, 'getAll']);
        Route::get('/{id}', [HazardController::class, 'get'])
            ->where('id', '^\d+$');
        Route::post('/', [HazardController::class, 'create']);
        Route::delete('/{id}', [HazardController::class, 'delete'])
            ->where('id', '^\d+$');
    }
);
