<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
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

Route::group(['middleware' => ['web']], function () {
    //user profile api
    Route::apiResource('post', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::apiResource('likes', LikeController::class);
    Route::get('home/{id}', [PostController::class, 'index']);
    Route::post('addcomment', [CommentController::class, 'store']);
    Route::post('likes', [LikeController::class, 'update']);
    Route::post('showlikes', [LikeController::class, 'show']);

});


  

