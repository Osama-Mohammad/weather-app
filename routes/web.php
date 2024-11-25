<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;

//verify.Register
Route::get('/', function () {
    $events= Event::all();
    return view('events.index',compact('events'));
})->name('home');

 Route::get('/register',[AuthController::class,'showRegisterForm'])->name('registerPage');
 Route::post('/register',[AuthController::class,'register'])->name('register');

 Route::get('/Login',[AuthController::class,'logPage'])->name('logPage');
 Route::post('/Login',[AuthController::class,'login'])->name('login');

Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::resource('user',UserController::class);

Route::resource('event',EventController::class);


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

