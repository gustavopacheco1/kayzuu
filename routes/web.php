<?php

use App\Http\Controllers\AccountController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/handle', [LoginController::class, 'handle'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register/handle', [RegisterController::class, 'handle'])->middleware('guest');
Route::get('/account', [AccountController::class, 'index'])->middleware('auth');
Route::get('/account/characters', [AccountController::class, 'characters'])->middleware('auth');
Route::get('/account/create-character', [AccountController::class, 'createCharacter'])->middleware('auth');
Route::post('/player/create', [PlayerController::class, 'create'])->middleware('auth');
Route::get('/search-player', [CommunityController::class, 'searchPlayer']);
Route::get('/highscore', [CommunityController::class, 'highscore']);
Route::get('/player/search', [PlayerController::class, 'search']);
Route::get('/player/{id}', [PlayerController::class, 'player']);

