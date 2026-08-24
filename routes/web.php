<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UpsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'active'])->group(function () {



    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Gestión de UPS
    |--------------------------------------------------------------------------
    */

    Route::resource('ups', UpsController::class)
        ->except(['destroy']);

    Route::delete('/ups/{up}', [UpsController::class, 'destroy'])
        ->middleware('admin')
        ->name('ups.destroy');

    /*
    |--------------------------------------------------------------------------
    | Fotografías
    |--------------------------------------------------------------------------
    */

    Route::post('/ups/{up}/fotografias', [FotografiaController::class, 'store'])
        ->name('fotografias.store');

    Route::delete('/fotografias/{fotografia}', [FotografiaController::class, 'destroy'])
        ->middleware('admin')
        ->name('fotografias.destroy');

    /*
    |--------------------------------------------------------------------------
    | Documentos
    |--------------------------------------------------------------------------
    */

    Route::post('/ups/{up}/documentos', [DocumentoController::class, 'store'])
        ->name('documentos.store');

    Route::get('/documentos/{documento}/descargar', [DocumentoController::class, 'download'])
        ->name('documentos.download');

    Route::delete('/documentos/{documento}', [DocumentoController::class, 'destroy'])
        ->middleware('admin')
        ->name('documentos.destroy');

    /*
    |--------------------------------------------------------------------------
    | Eventos
    |--------------------------------------------------------------------------
    */

    Route::resource('eventos', EventoController::class)
        ->only([
            'index',
            'create',
            'store',
            'show',
        ]);

    /*
    |--------------------------------------------------------------------------
    | Administración de usuarios
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {


    Route::resource('usuarios', UsuarioController::class)
                ->except(['show', 'destroy']);

    Route::patch('/usuarios/{usuario}/toggle-activo', [UsuarioController::class, 'toggleActivo'])
                ->name('usuarios.toggle-activo');

        });

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';