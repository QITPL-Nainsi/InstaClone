<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
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
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/signup', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [FeedController::class, 'index'])->name('dashboard');
    Route::get('/reels', [FeedController::class, 'reels'])->name('reels.index');
    Route::get('/profile/{user}', [FeedController::class, 'profile'])->name('profile.show');
    Route::post('/posts', [FeedController::class, 'store'])->name('posts.store');
    Route::post('/posts/{post}/like', [FeedController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comment', [FeedController::class, 'storeComment'])->name('posts.comment');
    Route::post('/users/{user}/follow', [FeedController::class, 'toggleFollow'])->name('users.follow');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
