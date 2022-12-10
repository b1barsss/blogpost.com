<?php

use Illuminate\{Support\Facades\Route,
        Support\Facades\Auth};
use App\{Http\Controllers\HomeController,
        Http\Controllers\PostController,
        Http\Controllers\PostTagController,
        Http\Controllers\PostCommentController,
        Http\Controllers\UserController,
        Http\Controllers\UserCommentController};

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
Route::resource('users.comments', UserCommentController::class)->only(['store']);

Route::resource('users', UserController::class)->only(['show', 'edit', 'update']);

Route::get('mailable/{commentId}', function($commentId)
{
    $comment = \App\Models\Comment::findOrFail($commentId);
    return  new \App\Mail\CommentPostedMarkdown($comment);
});

Auth::routes();

