<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayerController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('auth.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register.post');
    });

    Route::middleware('auth')->group(function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('password/change', [ChangePasswordController::class, 'change'])->name('password.change.post');
    });
});

Route::name('community.')->group(function () {
    Route::get('highscore', [CommunityController::class, 'highscore'])->name('highscore');
    Route::get('players/online', [CommunityController::class, 'online'])->name('online');
});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('general', [AccountController::class, 'general'])->name('general');
    Route::get('characters', [AccountController::class, 'characters'])->name('characters');
});

Route::prefix('player')->name('player.')->group(function () {
    Route::get('search', [PlayerController::class, 'search'])->name('search');
    Route::get('find', [PlayerController::class, 'find'])->name('find');
    Route::middleware('auth')->group(function () {
        Route::get('create', [PlayerController::class, 'create'])->name('create');
        Route::post('store', [PlayerController::class, 'store'])->name('store');
    });
    Route::get('{id}', [PlayerController::class, 'show'])->name('show');
});
