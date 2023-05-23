<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
#############################################
### ----------- Rutas Usuario ----------- ### 
#############################################

use App\Http\Controllers\UsuarioController;

// Ruta para crear un nuevo usuario
Route::post('/usuarios', [UsuarioController::class, 'create']);

// Ruta para obtener la información de un usuario específico
Route::get('/usuarios/{id}', [UsuarioController::class, 'read']);

// Ruta para actualizar la información de un usuario específico
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);

// Ruta para eliminar un usuario específico
Route::delete('/usuarios/{id}', [UsuarioController::class, 'delete']);

// Ruta para obtener la lista de usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);

// Ruta para banear a un usuario específico
Route::post('/usuarios/{id}/ban', [UsuarioController::class, 'ban']);



#################################################
### ----------- Rutas Publicacion ----------- ### 
#################################################
use App\Http\Controllers\PublicacionController;

// Ruta para crear una nueva publicación
Route::post('/publicaciones', [PublicacionController::class, 'create']);

// Ruta para obtener la información de una publicación específica
Route::get('/publicaciones/{id}', [PublicacionController::class, 'read']);

// Ruta para actualizar la información de una publicación específica
Route::put('/publicaciones/{id}', [PublicacionController::class, 'update']);

// Ruta para eliminar una publicación específica
Route::delete('/publicaciones/{id}', [PublicacionController::class, 'delete']);

// Ruta para obtener la lista de publicaciones de un usuario específico
Route::get('/usuarios/{usuario_id}/publicaciones', [PublicacionController::class, 'getUserPublicaciones']);

// Ruta para obtener la lista de publicaciones de los usuarios seguidos por un usuario específico
Route::get('/usuarios/{usuario_id}/publicaciones-seguidos', [PublicacionController::class, 'getFollowedUserPublicaciones']);



############################################
### ----------- Rutas Follow ----------- ### 
############################################

use App\Http\Controllers\FollowController;

// Ruta para crear un nuevo follow
Route::post('/follows', [FollowController::class, 'create']);

// Ruta para actualizar un follow específico
Route::put('/follows/{id}', [FollowController::class, 'update']);

// Ruta para eliminar un follow específico
Route::delete('/follows/{id}', [FollowController::class, 'delete']);

// Ruta para obtener los datos de un follow específico
Route::get('/follows/{id}', [FollowController::class, 'getFollowData']);


Route::get('/', function () {
    return view('welcome');
});
