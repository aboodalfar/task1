<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\Authenticate;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

############################# user ###############################
Route::softDeletes('users',UserController::class);
Route::controller(UserController::class)->prefix('users')->middleware(Authenticate::class)->group(function () {
    Route::get('', 'index')->name('users.index');
    Route::get('{id}', 'show')->name('users.show');
    Route::get('edit/{id}', 'edit')->name('users.edit');
    Route::put('{id}', 'update')->name('users.update');
    Route::delete('{id}', 'delete')->name('users.delete');
});
###################end###############################################3

