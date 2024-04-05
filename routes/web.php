<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::get('/', [PostController::class, 'index']);
Route::get('/my_posts', [PostController::class, 'show'])->middleware('auth');
Route::get('/posts/create_post', [PostController::class, 'create'])->middleware('auth');
Route::get('/posts/{id}', [PostController::class, 'getInfo'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth');
Route::post('/posts/publish/{id}', [PostController::class, 'publish'])->middleware('auth');
Route::post('/posts/draft/{id}', [PostController::class, 'draft'])->middleware('auth');
Route::post('/posts/edit/{id}', [PostController::class, 'update'])->middleware('auth');
Route::delete('/posts/delete/{id}', [PostController::class, 'delete'])->middleware('auth');

Route::post('/comments/{id}', [CommentController::class, 'store'])->middleware('auth');

Route::get('/dashboard_users', [UserController::class, 'index'])->middleware(['auth', 'admin']);
Route::post('/dashboard_users/admin/{id}', [UserController::class, 'admin'])->middleware(['auth', 'admin']);
Route::post('/dashboard_users/author/{id}', [UserController::class, 'author'])->middleware(['auth', 'admin']);
Route::delete('/dashboard_users/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'admin']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
]);
