<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TasksController;

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

Route::middleware([
    'auth:sanctum'
])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/tasks',
        [TasksController::class, 'index']
    )->name('api.tasks.index');
    Route::post('/tasks',
        [TasksController::class, 'store']
    )->name('api.tasks.store');
    Route::get('/tasks/{id}',
        [TasksController::class, 'show']
    )->name('api.tasks.show');
    Route::delete('/tasks/{id}',
        [TasksController::class, 'destroy']
    )->name('api.tasks.destroy');
});
