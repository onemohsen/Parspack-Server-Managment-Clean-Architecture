<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API V1 Routes
|--------------------------------------------------------------------------
*/

Route::get('/server/list-processes', App\Http\Controllers\Api\V1\Server\ListProcessController::class);


Route::middleware('auth:api')->group(function () {
});
