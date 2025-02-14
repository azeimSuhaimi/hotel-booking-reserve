<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\dashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(authController::class)->group(function () {

    Route::get('/auth','index')->name('auth')->middleware('guest');
    Route::post('/auth','login')->name('auth.login')->middleware(['guest']);

    Route::get('/create_account','create_account')->name('auth.create_account')->middleware('guest');
    Route::post('/create_account','create_account_process')->name('auth.create_account.create')->middleware('guest');

    Route::get('/logout','logout')->name('auth.logout');

    Route::get('/forgot_password', 'forgot_password')->name('auth.forgot_password')->middleware('guest');
    Route::post('/forgot_password', 'forgot_password_email')->name('auth.forgot_password.email')->middleware('guest');

    Route::get('/reset-password/{token}','reset')->name('password.reset')->middleware('guest');
    Route::post('/reset-password','reset_password')->name('password.update')->middleware('guest');

});// end group


Route::controller(dashboardController::class)->group(function () {

    Route::get('/dashboard','index')->name('dashboard')->middleware(['auth']);


});//end group
