<?php

use App\Http\Controllers\Api\{Integration};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('integration')->group(function () {
    Route::prefix('google')->group(function () {
        Route::resource('/directions', Integration\Google\GeolocationController::class)->middleware(['abilities:store-directions']);
    });
    Route::prefix('bwt')->group(function () {
        Route::resource('/lines', Integration\Bwt\BorderController::class);
    });
});
