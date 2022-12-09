<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\PostTagController;
use \App\Http\Controllers\PostCommentController;
use \App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'home'])
    ->name('home');
//    ->middleware('auth')
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/secret', [HomeController::class, 'secret'])->name('secret')->can('home.secret');

Route::resource("posts", PostController::class);
Route::get('/posts/tag/{tag}',[PostTagController::class, 'index'])->name('posts.tags.index');
Route::resource('posts.comments', PostCommentController::class)->only(['store']);

Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);

Auth::routes();

