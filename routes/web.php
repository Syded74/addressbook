<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressBookController;
use App\Http\Controllers\UserController;

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

// Basic welcome route
Route::get('/', function () {
    return view('welcome');
});
   
// Secure the Dashboard route      
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); 
// Resource routes for AddressBook with authentication
Route::middleware(['auth'])->group(function () {
    Route::resource('addressbook', AddressBookController::class);
    Route::resource('users', UserController::class);                                                                                                           
});

// Authentication routes provided by Laravel Breeze or similar
require __DIR__.'/auth.php';
