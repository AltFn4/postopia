<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/comment', [CommentController::class, 'create'])->middleware(['auth', 'verified'])->name('comment.create');

Route::middleware('auth')->group(function () {
    Route::get('/forum', [PostController::class, 'index'])->name('forum');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post', [PostController::class, 'create'])->name('post.create');
    Route::patch('/post', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/notification', [NotificationController::class, 'show'])->name('notification.show');
    Route::delete('/notification', [NotificationController::class, 'destroy'])->name('notification.destroy');
});

require __DIR__.'/auth.php';
