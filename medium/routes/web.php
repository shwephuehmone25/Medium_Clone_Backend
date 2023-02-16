<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('categories', CategoryController::class);

    /**Post */
    Route::get('/', [PostController::class, 'showAllPosts'])->name('lists');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/create', [PostController::class, 'store'])->name('post.store');
    Route::post('posts/edit/{post}', [PostController::class, 'update'])->name('post.update');
    Route::get('posts/edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('posts/show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('category/{category_id}', [PostController::class, 'relatedPosts'])->name('category.show');
    Route::post('post/like', [PostController::class, 'like'])->name('post.like');
    Route::delete('post/like', [PostController::class, 'unlike'])->name('post.unlike');

    /**Comment*/
    Route::get('/comments/create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/comments/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/reply/store', [CommentController::class, 'replyStore'])->name('reply.add');
    Route::get('comment/edit/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('comment/edit/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    /**User*/
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('users/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
    Route::get('/password/change', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/password/change/{id}', [UserController::class, 'updatePassword'])->name('password.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('mail/send', [AuthController::class, 'sendMail']);

/* Google Social Login */
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*Guest*/
Route::get('/', [PostController::class, 'showAllPosts'])->name('lists');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});