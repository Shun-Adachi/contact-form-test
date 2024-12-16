<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
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
Route::prefix('/')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'index']);
});

Route::prefix('/confirm')->group(function () {
    Route::post('/', [ContactController::class, 'confirm']);
    Route::post('/create', [ContactController::class, 'store']);
});

Route::prefix('/thanks')->group(function () {
    Route::get('/', [ContactController::class, 'thanks']);
});

Route::middleware('auth')->group(function () {
     Route::prefix('/admin')->group(function () {
          Route::get('/', [ContactController::class, 'admin']);
          Route::get('/search', [ContactController::class, 'search']);
          Route::get('/export', [ContactController::class, 'export']);
          Route::delete('/delete', [ContactController::class, 'destroy']);
     });
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // カスタムリダイレクト先
})->name('logout');