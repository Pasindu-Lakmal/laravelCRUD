<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/product', ProductController::class);
Route::resource('/post', PostsController::class);

Route::post('/unlike/{post_id}', [PostsController::class, 'unlike'])->name('remove.like');
Route::post('/add-like/{post_id}', [PostsController::class, 'addLike'])->name('add.like');
Route::get('/add-like-form', [PostsController::class, 'showAddLikeForm']);