<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StudentController;

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

// Route::view('master','layouts.master');

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('cars', CarController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('products', ProductController::class);
    Route::resource('students', StudentController::class);
    Route::put('/students/update-is_active/{student}', 'StudentController@updateIsActive')->name('students.update-is_active');
});