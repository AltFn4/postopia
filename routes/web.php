<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
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

Route::get('/forum', [ForumController::class, 'list'])->middleware(['auth', 'verified'])->name('forum');

Route::middleware('auth')->group(function () {
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post', [PostController::class, 'create'])->name('post.create');
    Route::patch('/post', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
