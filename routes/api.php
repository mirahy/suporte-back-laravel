<?php

use App\Http\Controllers\Api\LoginApiController;
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

Route::middleware('corsApi')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // LoginApiController routes
        Route::controller(LoginApiController::class)->group(function() {
            Route::get('/logado', 'usuarioLogado');
            Route::get('/logout', 'logout');
        });
        // UserController routes
        Route::controller(UserController::class)->group(function() {
            Route::get('/get-tokens-user', 'getAllTokensUser');
            Route::get('/revoke-tokens-user', 'revokeAllTokensUser');
            Route::get('/get-first-last-name-user', 'getFirstLastNameUser');
            Route::get('/usuarios/lista', 'all');
            Route::resource('usuarios', 'UserController');
        });
  
        
    });

    Route::post('/login', [LoginApiController::class, 'login']);
    
    
});
