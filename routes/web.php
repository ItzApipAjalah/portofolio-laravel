<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\InternetController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\CheckVisitor;

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

Route::get('/', [HomeController::class, 'index'])->middleware('check.visitor');

Route::post('/visitor', [VisitorController::class, 'store']);
Route::get('/visitor/count', [VisitorController::class, 'count']);
Route::get('/error.php', function () {
    abort(666);
});
Route::get('/no-internet', [App\Http\Controllers\InternetController::class, 'noInternet'])->name('no-internet');
