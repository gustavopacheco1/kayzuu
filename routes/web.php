<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\GuildInviteController;
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

Route::name('guild.')->group(function () {
    Route::get('guilds', [GuildController::class, 'index'])->name('index');
    Route::middleware('auth')->group(function () {
        Route::get('guild/create', [GuildController::class, 'create'])->name('create');
        Route::post('guild/store', [GuildController::class, 'store'])->name('store');
        Route::prefix('guild/{guild}')->group(function () {
            Route::get('invite', [GuildInviteController::class, 'showInviteForm'])->name('invite');
            Route::post('invite', [GuildInviteController::class, 'invite'])->name('invite.post');
            Route::post('invite/accept/{player}', [GuildInviteController::class, 'accept'])->name('invite.accept');
            Route::delete('invite/cancel/{player}', [GuildInviteController::class, 'cancel'])->name('invite.cancel');
            Route::delete('kick/{player}', [GuildInviteController::class, 'kick'])->name('kick');
        });
    });
    Route::get('guild/{guild}', [GuildController::class, 'show'])->name('show');
});

Route::prefix('download')->name('download.')->group(function () {
    Route::get('/', [DownloadController::class, 'index'])->name('index');
});

Route::prefix('account')->name('account.')->middleware('auth')->group(function () {
    Route::get('general', [AccountController::class, 'general'])->name('general');
    Route::get('characters', [AccountController::class, 'characters'])->name('characters');
});

Route::name('player.')->group(function () {
    Route::get('highscore/{skillType?}', [PlayerController::class, 'highscore'])->name('highscore');
    Route::get('online', [PlayerController::class, 'online'])->name('online');
    Route::prefix('player')->group(function () {
        Route::get('search', [PlayerController::class, 'search'])->name('search');
        Route::get('find', [PlayerController::class, 'find'])->name('find');
        Route::middleware('auth')->group(function () {
            Route::get('create', [PlayerController::class, 'create'])->name('create');
            Route::post('store', [PlayerController::class, 'store'])->name('store');
        });
        Route::get('{player}', [PlayerController::class, 'show'])->name('show');
    });
});
