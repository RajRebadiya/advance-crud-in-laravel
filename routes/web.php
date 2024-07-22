<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register_show')->name('register');
    Route::get('login', 'login_show')->name('login');
    Route::post('registration', 'register')->name('registration');
    Route::post('login', 'login')->name('login');
    Route::post('edit-use', 'edit')->name('edit');
    Route::get('delete-user/{id}', 'delete')->name('delete-user');
    Route::get('edit-user/{id}', 'edit_show')->name('edit-user');
});
