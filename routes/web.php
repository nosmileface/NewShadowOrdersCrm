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

        Route::prefix('{clientCategory}')->group(function () {
            // Clients
            Route::prefix('clients')
                ->name('clients.')->group(function () {
                    Route::get('/', [
                        Controllers\ClientCategory\Client\ClientController::class, 'index'
                    ])->name('index');

                    Route::post('/', [
                        Controllers\ClientCategory\Client\ClientController::class, 'store'
                    ])->name('store');

                    Route::put('{client}', [
                        Controllers\ClientCategory\Client\ClientController::class, 'update'
                    ])->name('update');

                    Route::delete('{client}', [
                        Controllers\ClientCategory\Client\ClientController::class, 'destroy'
                    ])->name('destroy');

                    Route::put('{client}/toggle', [
                        Controllers\ClientCategory\Client\ClientController::class, 'toggle'
                    ])->name('toggle');


                    // Client-statuses
                    Route::prefix('{client}/client-statuses')
                        ->name('client-statuses.')->group(function () {
                            Route::get('/', [
                                Controllers\ClientCategory\Client\Status\ClientStatusController::class, 'index'
                            ])->name('index');

                            Route::post('/', [
                                Controllers\ClientCategory\Client\Status\ClientStatusController::class, 'store'
                            ])->name('store');

                            Route::put('{clientStatus}', [
                                Controllers\ClientCategory\Client\Status\ClientStatusController::class, 'update'
                            ])->name('update');

                            Route::delete('{clientStatus}', [
                                Controllers\ClientCategory\Client\Status\ClientStatusController::class, 'destroy'
                            ])->name('destroy');
                        });
                });

            // Client-status-categories
            Route::prefix('status-categories')
                ->name('status-categories.')->group(function () {
                    Route::get('/', [
                        Controllers\ClientCategory\Client\Status\Category\ClientStatusCategoryController::class, 'index'
                    ])->name('index');

                    Route::post('/', [
                        Controllers\ClientCategory\Client\Status\Category\ClientStatusCategoryController::class, 'store'
                    ])->name('store');

                    Route::put('{clientStatusCategory}', [
                        Controllers\ClientCategory\Client\Status\Category\ClientStatusCategoryController::class, 'update'
                    ])->name('update');

                    Route::delete('{clientStatusCategory}', [
                        Controllers\ClientCategory\Client\Status\Category\ClientStatusCategoryController::class, 'destroy'
                    ])->name('destroy');

                    Route::put('{clientStatusCategory}/toggle', [
                        Controllers\ClientCategory\Client\Status\Category\ClientStatusCategoryController::class, 'toggle'
                    ])->name('toggle');
                });
        });
    });
