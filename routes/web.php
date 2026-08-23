<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return redirect()->route('dashboard');

});

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Gestión de UPS
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'ups',
        UpsController::class
    );

    Route::get(
        '/ups/busqueda',
        [UpsController::class, 'search']
    )->name('ups.search');

    /*
    |--------------------------------------------------------------------------
    | Eventos
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'eventos',
        EventoController::class
    )->only([
        'index',
        'create',
        'store',
        'show',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

require __DIR__.'/auth.php';