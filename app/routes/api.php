<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//

Route::apiResource('alumnos', AlumnoController::class);
Route::get('/alumnos', [AlumnoController::class, 'index']);
Route::get('/alumnos/{id}', [AlumnoController::class, 'show']);
Route::post('/alumnos', [AlumnoController::class, 'store']);
Route::put('/alumnos/{id}', [AlumnoController::class, 'update']);
Route::delete('/alumnos/{id}', [AlumnoController::class, 'destroy']);

Route::apiResource('asignaturas', AsignaturaController::class);
Route::get('/asignaturas', [AsignaturaController::class, 'index']);
Route::get('/asignaturas/{id}', [AsignaturaController::class, 'show']);
Route::post('/asignaturas', [AsignaturaController::class, 'store']);
Route::put('/asignaturas/{id}', [AsignaturaController::class, 'update']);
Route::delete('/asignaturas/{id}', [AsignaturaController::class, 'destroy']);

Route::apiResource('notas', NotaController::class);
Route::get('/notas', [NotaController::class, 'index']);
Route::get('/notas/{id}', [NotaController::class, 'show']);
Route::post('/notas', [NotaController::class, 'store']);
Route::put('/notas/{id}', [NotaController::class, 'update']);
Route::delete('/notas/{id}', [NotaController::class, 'destroy']);

Route::apiResource('perfiles', PerfilController::class);
Route::get('/perfiles', [PerfilController::class, 'index']);
Route::get('/perfiles/{id}', [PerfilController::class, 'show']);
Route::post('/perfiles', [PerfilController::class, 'store']);
Route::put('/perfiles/{id}', [PerfilController::class, 'update']);
Route::delete('/perfiles/{id}', [PerfilController::class, 'destroy']);

Route::apiResource('posts', PostController::class);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::get('/posts/user/{id}', [PostController::class, 'postsByUser']);
