<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\FollowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
#############################################
### ----------- Rutas Usuario ----------- ###
#############################################


Route::prefix('usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/{id}', [UsuarioController::class, 'read'])->name('usuarios.read');
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{id}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
    Route::post('/{id}/ban', [UsuarioController::class, 'ban'])->name('usuarios.ban');
    Route::get('/lista', [UsuarioController::class, 'lista'])->name('usuarios.lista');
});
#################################################
### ----------- Rutas Publicacion ----------- ###
#################################################

Route::prefix('publicaciones')->group(function () {
    Route::post('/', [PublicacionController::class, 'create'])->name('publicaciones.create');
    Route::get('/{id}', [PublicacionController::class, 'read'])->name('publicaciones.read');
    Route::put('/{id}', [PublicacionController::class, 'update'])->name('publicaciones.update');
    Route::delete('/{id}', [PublicacionController::class, 'delete'])->name('publicaciones.delete');
    Route::get('/usuarios/{usuario_id}', [PublicacionController::class, 'getUserPublicaciones'])->name('publicaciones.user');
    Route::get('/usuarios/{usuario_id}/publicaciones-seguidos', [PublicacionController::class, 'getFollowedUserPublicaciones'])->name('publicaciones.followed');
});


############################################
### ----------- Rutas Follow ----------- ###
############################################

Route::prefix('follows')->group(function () {
    Route::post('/', [FollowController::class, 'create'])->name('follows.create');
    Route::put('/{id}', [FollowController::class, 'update'])->name('follows.update');
    Route::delete('/{id}', [FollowController::class, 'delete'])->name('follows.delete');
    Route::get('/{id}', [FollowController::class, 'getFollowData'])->name('follows.data');
});

// Ruta Login
Route::get('/login', function () {
    return view('layout.login');
})->name('login');

Route::post('/login', [UsuarioController::class, 'login'])->name('login.post');

// Rutas de prueba:
Route::view('/crear-usuario', 'layout.usuarios.crear')->name('usuarios.create-view');
Route::view('/', 'layout.master')->name('home');

//ruta prueva lista publicaciones SEGUIDOS:
Route::middleware('guest')->get('/usuarios-seguidos-guest', [UsuarioController::class, 'obtenerPublicacionesSeguidos'])
    ->name('usuariosSeguidosGuest');

Route::middleware('auth')->get('/usuarios-seguidos', [UsuarioController::class, 'obtenerPublicacionesSeguidos'])
    ->name('usuariosSeguidos');

//ruta prueva lista publicaciones NO SEGUIDOS:
Route::middleware('guest')->get('/usuarios-no-seguidos-guest', [UsuarioController::class, 'obtenerPublicacionesNoSeguidos'])
    ->name('usuariosNoSeguidosGuest');

Route::middleware('auth')->get('/usuarios-no-seguidos', [UsuarioController::class, 'obtenerPublicacionesNoSeguidos'])
    ->name('usuariosNoSeguidos');
