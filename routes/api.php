<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ShortLinkController;

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
Route::prefix('shortlinks')->group(function () {
    Route::get('/', [ShortLinkController::class, 'index']);
    Route::get('/{id}', [ShortLinkController::class, 'show']);
    Route::post('/', [ShortLinkController::class, 'store']);
    Route::put('/{id}', [ShortLinkController::class, 'update']);
    Route::delete('/{id}', [ShortLinkController::class, 'destroy']);
});