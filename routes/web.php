<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/api/github-projects', [APIController::class, 'fetchGitHubProjects']);
Route::get('/api/last-commit-title', [APIController::class, 'fetchLastCommitTitle']);
Route::get('/api/discord-status', [APIController::class, 'fetchDiscordStatus']);
Route::get('/api/anime-recommendations', [APIController::class, 'fetchAnimeRecommendations']);
Route::get('/api/waifu-image', [APIController::class, 'fetchWaifuImage']);
