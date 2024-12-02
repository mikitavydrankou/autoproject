<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('welcome');
})->middleware('guest');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/admin', function () {
    return view('admin');
})->name('admin')->middleware('role:0');

Route::get('/repair-car', function () {
    return redirect()->route('check-account', ['type' => 'repair']);
})->name('repair-car');

Route::get('/have-service', function () {
    return redirect()->route('check-account', ['type' => 'service']);
})->name('have-service');

Route::get('/check-account/{type}', function ($type) {
    return view('check-account', ['type' => $type]);
})->name('check-account');


Route::get('/test', function () {
    dd(Auth::user()->role_id);
});

Route::resource('cars', CarController::class);
Route::get('/my-cars', [CarController::class, 'index'])->middleware('role:2')->name('my-cars');

Route::get('/my-requests', [RequestController::class, 'my_index'])->middleware('role:2')->name('my-requests');
Route::get('/my-requests/create', [RequestController::class, 'my_create'])->middleware('role:2')->name('my-requests.create');
Route::post('/my-requests/store', [RequestController::class, 'my_store'])->middleware('role:2')->name('my-requests.store');

