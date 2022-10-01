<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Member\WebhookController;
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

Route::post('webhook', [WebhookController::class, 'handler']);

// Route::post('auth', [AuthController::class, 'auth']);

// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('movies', [MovieController::class,'index']);
//     Route::get('movies/{id}', [MovieController::class,'show']);
// });

