<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:sanctum')->group(function () {
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

Route::group(['middleware'=>'auth:sanctum', 'prefix'=> 'pokemons'], function () {
    Route::get('/', [App\Http\Controllers\PokemonController::class, 'index']);
    Route::get('/{pokemon}', [App\Http\Controllers\PokemonController::class, 'show']);
    Route::put('/{pokemon}', [App\Http\Controllers\PokemonController::class, 'update']);
});
