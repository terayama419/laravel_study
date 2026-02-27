<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Test;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\SupplierController;

Route::get('/', Test::class);

Route::resource('foods', FoodController::class);
Route::post('foods/{food}/add-stock', [FoodController::class, 'addStock'])->name('foods.addStock');

Route::resource('manufacturers', ManufacturerController::class);
Route::resource('suppliers', SupplierController::class);