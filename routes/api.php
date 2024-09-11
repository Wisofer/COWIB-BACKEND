<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Proyectos\ProyectosController;
use App\Http\Controllers\Servicios\ServiciosController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rutas de autenticación
Route::middleware(['web'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/test', [AuthenticatedSessionController::class, 'test']);
});

// Obtener el usuario autenticado (puedes descomentar esta ruta para pruebas si lo necesitas)
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para proyectos (GET y POST)
Route::get('/proyectos', [ProyectosController::class, 'index']);
Route::post('/proyectos', [ProyectosController::class, 'store']);

// Rutas para servicios (GET y POST)
Route::get('/servicios', [ServiciosController::class, 'index']);
Route::post('/servicios', [ServiciosController::class, 'store']);