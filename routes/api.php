<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;

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

Route::middleware('api')->get('/getMatches', [FootballController::class, 'getMatches']);
/*Route::middleware('api')->group(function () {
    Route::resource('matches', FootballController::class);
});*/
//Route::resource('matches', FootballController::class)->only('getMatches');

