<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Dashboard;
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

Route::get('/addClient', function () {
    return view('admin.clients.add');
})->name('addClient');

Route::get('/', [Dashboard::class, 'index']);

Route::post('/create', [ClientController::class, 'create'])->name('create');
Route::get('/clients', [ClientController::class, 'index'])->name('clients');
Route::post('/clientsSearch', [ClientController::class, 'search'])->name('clientsSearch');
Route::get('/client/{id}', [ClientController::class, 'edit'])->name('client');
Route::post('/storeClient/{id}', [ClientController::class, 'store'])->name('storeClient');
Route::get('/delete/{id}', [ClientController::class, 'delete'])->name('delete');

Route::post('/createCar', [CarController::class, 'create'])->name('createCar');
Route::post('/updateCar/{id}', [CarController::class, 'update'])->name('updateCar');
Route::get('/deleteCar/{id}', [CarController::class, 'delete'])->name('deleteCar');
Route::get('/carsOnPark', [CarController::class, 'onPark'])->name('onPark');
Route::post('/carsSearch', [CarController::class, 'search'])->name('carsSearch');
Route::get('/carsOutPark/{id}', [CarController::class, 'outPark'])->name('outPark');

Route::get('/cars', function () {
    return view('admin.cars.index');
});
