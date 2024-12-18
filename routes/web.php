<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceRequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('welcome');
})->middleware('guest');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');



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
Route::resource('cars', CarController::class);
Route::get('/my-cars', [CarController::class, 'user_cars'])->middleware('role:2')->name('my-cars');

Route::get('client/requests', [\App\Http\Controllers\ServiceRequestController::class, 'client_index'])->name('client.requests');
Route::get('client/requests/create', [\App\Http\Controllers\ServiceRequestController::class, 'create'])->name('client.requests.create');
Route::post('client/requests/store', [\App\Http\Controllers\ServiceRequestController::class, 'store'])->name('client.requests.store');
Route::delete('client/requests/delete/{service_request}', [\App\Http\Controllers\ServiceRequestController::class, 'destroy'])->name('client.requests.destroy');
Route::get('client/requests/show/{service_request}', [\App\Http\Controllers\ServiceRequestController::class, 'show'])->name('client.requests.show');
Route::get('client/requests/edit/{service_request}', [\App\Http\Controllers\ServiceRequestController::class, 'edit'])->name('client.requests.edit');
Route::patch('client/requests/update/{id}', [\App\Http\Controllers\ServiceRequestController::class, 'update'])->name('client.requests.update');

Route::get('service/requests', [ServiceRequestController::class, 'service_index'])->name('service.requests');
Route::post('service/offers/store', [\App\Http\Controllers\ServiceOffersController::class, 'store'])->name('service.offers.store');
