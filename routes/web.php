<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::controller(AdminController::class)->group(function () {

    Route::get('/admin/dashboard', 'admindashboard')->name('admin.dashboard')->middleware(['auth', 'adminRole:admin']);
    Route::get('/admin/logout', 'adminlogout')->name('admin.logout')->middleware(['auth', 'adminRole:admin']);
    Route::get('/admin/profile', 'adminprofile')->name('admin.profile')->middleware(['auth', 'adminRole:admin']);
    Route::post('/admin/password/update', 'AdminPasswordUpdate')->name('admin.password.update')->middleware(['auth', 'adminRole:admin']);
    Route::get('/admin/login', 'adminlogin')->name('admin.login');

    Route::post('/admin/update/profile','update_profile')->name('admin.update.profile')->middleware(['auth', 'adminRole:admin']);
    Route::post('/admin/remove/image','remove_image')->name('admin.remove.image')->middleware(['auth', 'adminRole:admin']);
    Route::post('/admin/update/image','update_image')->name('admin.update.image')->middleware(['auth', 'adminRole:admin']);

}); //end group
