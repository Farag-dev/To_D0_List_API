<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/all.task', [App\Http\Controllers\WorksController::class, 'index'])->name('work.index');
    Route::post('/add.task', [App\Http\Controllers\WorksController::class, 'store'])->name('work.store');
    Route::delete('/delete.task/{id}', [App\Http\Controllers\WorksController::class, 'destroy'])->name('work.destroy');
    Route::put('/update.task/{id}', [App\Http\Controllers\WorksController::class, 'update'])->name('work.update');



