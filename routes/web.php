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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->prefix('user-manager')->group(function () {
    Route::get('/dashboard', function () {
        return view('user-manager.index');
    });

    Route::get('/users', function(){
        return view('user-manager.users');
    });

    Route::get('/roles', function(){
        return view('user-manager.roles');
    });

    Route::get('/permissions', function(){
        return view('user-manager.permissions');
    });
});

require __DIR__.'/auth.php';
