<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});

// Client-categories
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

        // Clients

        Route::prefix('{clientCategory}')
            ->name('clients.')->group(function () {
                Route::get('/', [
                    Controllers\ClientCategory\Client\ClientController::class, 'index'
                ])->name('index');

                Route::post('/', [
                    Controllers\ClientCategory\Client\ClientController::class, 'store'
                ])->name('store');

                Route::put('clients/{client}', [
                    Controllers\ClientCategory\Client\ClientController::class, 'update'
                ])->name('update');

                Route::delete('clients/{client}', [
                    Controllers\ClientCategory\Client\ClientController::class, 'destroy'
                ])->name('destroy');

                Route::put('clients/{client}/toggle', [
                    Controllers\ClientCategory\Client\ClientController::class, 'toggle'
                ])->name('toggle');
            });
    });
