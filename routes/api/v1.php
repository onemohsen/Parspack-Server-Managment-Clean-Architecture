<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
*/

Route::get('/server/list-processes', App\Http\Controllers\Api\V1\Server\ListProcessController::class);
Route::get('/server/list-directory', App\Http\Controllers\Api\V1\Server\ListDirectoryController::class);
Route::post('/server/create-directory', App\Http\Controllers\Api\V1\Server\CreateDirectoryController::class);
Route::post('/server/create-file', App\Http\Controllers\Api\V1\Server\CreateFileController::class);


Route::middleware('auth:api')->group(function () {
});
