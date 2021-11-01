<?php

use App\Http\Controllers\ShippedItemController;
use App\Http\Controllers\RetailCenterController;
use App\Http\Controllers\TransportationEventController;
use App\Models\RetailCenter;
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

Route::get('/', function () {
    return view('welcome');
});

//Retail Center
Route::get('/retails', [RetailCenterController::class, 'index'])->name('retails.index');
Route::get('/retails/create', [RetailCenterController::class, 'create'])->name('retails.create');
Route::get('/retails/{retail}/edit', [RetailCenterController::class, 'edit'])->name('retails.edit');
Route::post('/retails', [RetailCenterController::class, 'store'])->name('retails.store');
Route::put('/retails/{retail}', [RetailCenterController::class, 'update'])->name('retails.update');
Route::delete('/retails/{retail}', [RetailCenterController::class, 'destroy'])->name('retails.destroy');

//Shipped Item
Route::get('/items', [ShippedItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ShippedItemController::class, 'create'])->name('items.create');
Route::get('/items/{item}/edit', [ShippedItemController::class, 'edit'])->name('items.edit');
Route::post('/items', [ShippedItemController::class, 'store'])->name('items.store');
Route::put('/items/{item}', [ShippedItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ShippedItemController::class, 'destroy'])->name('items.destroy');

//Transportation Event
Route::get('/events', [TransportationEventController::class, 'index'])->name('events.index');
Route::get('/events/create', [TransportationEventController::class, 'create'])->name('events.create');
Route::get('/events/{event}/edit', [TransportationEventController::class, 'edit'])->name('events.edit');
Route::post('/events', [TransportationEventController::class, 'store'])->name('events.store');
Route::put('/events/{event}', [TransportationEventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [TransportationEventController::class, 'destroy'])->name('events.destroy');



