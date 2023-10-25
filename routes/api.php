<?php

use App\Http\Controllers\Api\CursosMoodleController;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\PeriodosLetivosController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// LoginApiController routes
Route::controller(LoginApiController::class)->group(function () {
    Route::post('/login',  'login');
    Route::get('/logado', 'usuarioLogado')->middleware(['auth:sanctum']);
    Route::get('/logout', 'logout')->middleware(['auth:sanctum']);
});


Route::middleware(['auth:sanctum', 'authsession'])->group(function () {

    // UserController routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/get-tokens-user', 'getAllTokensUser');
        Route::get('/revoke-tokens-user', 'revokeAllTokensUser');
        Route::get('/get-first-last-name-user', 'getFirstLastNameUser');
        Route::get('/usuarios/lista', 'all');
        Route::get('/salas/usuarios', 'list');
        Route::resource('usuarios', 'UserController');
    });

    // PeriodosLetivosController routes
    Route::controller(PeriodosLetivosController::class)->group(function () {
        Route::get('/periodo-letivos/all', 'all');
        Route::resource('/periodo-letivos', 'PeriodosLetivosController');
    });

    // CursosMoodleController routes
    Route::controller(CursosMoodleController::class)->group(function () {
        Route::get('/meus-cursos', 'meusCursos');
        Route::get('/td-cursos', 'todosCursos');
        Route::post('/get-meus-cursos', 'getMoodlesComCursos');
        Route::post('/get-moodles', 'getMoodles');
        Route::post('/go-moodle', 'goMoodle');
    });
});
