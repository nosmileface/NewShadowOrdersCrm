<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('client-categories')
    ->name('client-categories.')->group(function () {
        Route::get('/', [
            Controllers\ClientCategory\ClientCategoryController::class, 'index'
        ])->name('index');

        Route::post('/', [
            Controllers\ClientCategory\ClientCategoryController::class, 'store'
        ])->name('store');

        Route::put('{clientCategory}', [
            Controllers\ClientCategory\ClientCategoryController::class, 'update'
        ])->name('update');

        Route::delete('{clientCategory}', [
            Controllers\ClientCategory\ClientCategoryController::class, 'destroy'
        ])->name('destroy');
    });
