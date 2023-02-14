<?php

use App\Http\Controllers\AppetaleController;
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
    return view('login');
});
Route::post('login', [AppetaleController::class, 'login'])->name('login');
Route::get('logout', [AppetaleController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AppetaleController::class, 'dashboard'])->name('dashboard');
    Route::post('user/update', [AppetaleController::class, 'updateUserInfo'])->name('user.update');
});
