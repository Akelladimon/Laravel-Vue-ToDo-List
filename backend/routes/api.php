<?php

use App\Http\Controllers\TaskController;
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

Route::group(['middleware' => 'guest'],  function () {
    Route::get(
        '/tasks',
        [TaskController::class, 'index']
    );

    Route::post(
        '/task',
        [TaskController::class, 'store']
    );

    Route::patch(
        '/task/{task}',
        [TaskController::class, 'update']
    );

    Route::delete(
        '/task/{task}',
        [TaskController::class, 'destroy']
    );
});
