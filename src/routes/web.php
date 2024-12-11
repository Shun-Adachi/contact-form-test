<?php

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
     return view('index');
});


Route::get('/confirm', function () {
     return view('confirm');
});


Route::get('/admin', function () {
     return view('admin');
});


Route::get('/login', function () {
     return view('login');
});


Route::get('/register', function () {
     return view('register');
});


Route::get('/thanks', function () {
     return view('thanks');
});
