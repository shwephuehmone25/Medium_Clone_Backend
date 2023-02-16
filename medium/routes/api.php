<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->group(function () {
/**Post */
    Route::get('/lists', [PostController::class, 'showAllPosts']);
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::post('posts/edit/{post}', [PostController::class, 'update']);
    Route::get('posts/show/{id}', [PostController::class, 'show']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('related/category/{category_id}', [PostController::class, 'relatedPosts']);
    Route::post('post/like', [PostController::class, 'like']);
    Route::delete('post/like', [PostController::class, 'unlike']);

/**Comment*/
    Route::get('/comments/create', [CommentController::class, 'create']);
    Route::post('/comments/store', [CommentController::class, 'store']);
    Route::post('/reply/store', [CommentController::class, 'replyStore']);
    Route::get('comment/edit/{comment}', [CommentController::class, 'edit']);
    Route::post('comment/edit/{comment}', [CommentController::class, 'update']);
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy']);

/**User*/
    Route::get('users/edit/{id}', [UserController::class, 'edit']);
    Route::post('users/edit/{id}', [UserController::class, 'update']);
    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::post('/password/change/{id}', [UserController::class, 'updatePassword']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});

Route::get('/home', [HomeController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('mail/send', [AuthController::class, 'sendMail']);

/*Guest*/
Route::get('/lists', [PostController::class, 'showAllPosts']);
Route::get('/logout', [HomeController::class, 'logout']);