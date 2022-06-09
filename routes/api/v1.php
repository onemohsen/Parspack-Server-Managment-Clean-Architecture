<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
*/


Route::post('/login', App\Http\Controllers\Api\V1\Users\LoginController::class)->name('login'); // route('api.v1.login')
Route::post('/register', App\Http\Controllers\Api\V1\Users\RegisterController::class)->name('register'); // route('api.v1.register')



Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'server', 'as' => 'server.'], function () {
        Route::get('/list-processes', App\Http\Controllers\Api\V1\Server\ListProcessController::class)->name('list-processes'); // route('api.v1.server.list-processes')
        Route::get('/list-directories', App\Http\Controllers\Api\V1\Server\ListDirectoriesController::class)->name('list-directories'); // route('api.v1.server.list-directories')
        Route::get('/list-files', App\Http\Controllers\Api\V1\Server\ListFilesController::class)->name('list-files'); // route('api.v1.server.list-files')
        Route::post('/create-directory', App\Http\Controllers\Api\V1\Server\CreateDirectoryController::class)->name('create-directory'); // route('api.v1.server.create-directory')
        Route::post('/create-file', App\Http\Controllers\Api\V1\Server\CreateFileController::class)->name('create-file'); // route('api.v1.server.create-file')
    });
});
