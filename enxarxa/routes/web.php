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

// Ruta prueba lista publicaciones SEGUIDOS para usuarios autenticados
Route::get('/usuarios-seguidos', [UsuarioController::class, 'obtenerPublicacionesSeguidos'])
    ->name('usuariosSeguidos')->middleware('auth');

// Ruta prueba lista publicaciones NO SEGUIDOS para usuarios autenticados
Route::get('/usuarios-no-seguidos', [UsuarioController::class, 'obtenerPublicacionesNoSeguidos'])
    ->name('usuariosNoSeguidos')->middleware('auth');

// Rutas Login/out
Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.post');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');

// Rutas Usuario
Route::get('/usuarios/lista', [UsuarioController::class, 'lista'])->name('usuarios.lista');
Route::get('/lista', [UsuarioController::class, 'lista'])->name('lista');

// Rutas Publicacion

// Rutas Follow
Route::get('/error', function () {
    return view('layout.error');
})->name('error');

// Rutas de prueba
Route::view('/crear-usuario', 'layout.usuarios.crear')->name('usuarios.create-view');
Route::view('/', 'layout.master')->name('home');
