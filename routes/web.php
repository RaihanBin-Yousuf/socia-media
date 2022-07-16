<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('allpost', [PostController::class, 'test'])->name('allpost');
Route::get('allpost/{id}', [UserController::class, 'test'])->name('user.allpost');

Route::get('users', [UserController::class, 'index']);
Route::get('list/users', [UserController::class, 'userlist'])->name('loadmore');
Route::get('list/users/{id}', [UserController::class, 'userlist'])->name('user.data');
Route::view('/rahi', 'test.rahi');




Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [PostController::class, 'index'])->name('home');
    Route::get('home/{id}', [PostController::class, 'index'])->name('loadmorepost');
    Route::put('UpdateUserprofile', [UserController::class, 'update'])->name('UpdateUserprofile');
    Route::view('profileview', 'auth.profile.viewprofile')->name('profile');
    Route::view('updateprofile', 'auth.profile.updateprofile')->name('updateprofile');
    Route::view('updatepassword', 'auth.profile.updatepassword')->name('updatepassword');
    Route::resource('posts', PostController::class);
    Route::get('mypost', [PostController::class, 'mypost'])->name('mypost');
    Route::get('deleteUserPost/{id}', [PostController::class, 'destroy'])->name('deleteUserPost');
    Route::resource('comments', CommentController::class);
    Route::post('showcomments', [CommentController::class, 'show'])->name('showcomments');
    Route::post('addcomment', [CommentController::class, 'store'])->name('addcomment');
    Route::post('likes', [LikeController::class, 'update'])->name('post.likes');
    Route::post('showlikes', [LikeController::class, 'show'])->name('showlikes');
});
