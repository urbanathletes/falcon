<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\PromoFalconController;
use App\Http\Controllers\PromoFalconLongController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\RemoveAccountController;
use App\Http\Controllers\PromoSamatorController;
use App\Http\Controllers\RefferalController;

// Route::resource('/', AdsController::class);

/**
 * sort
 */
Route::resource('/', PromoFalconController::class);
Route::post('/order', [PromoFalconController::class, 'order']);

/**
 * long
 */

// Route::resource('/presale', PromoFalconLongController::class);
// Route::post('/order', [PromoFalconLongController::class, 'order']);

// Show the personal info form (step 1)
Route::get('/presale/info', [PromoFalconLongController::class, 'showInfoForm'])->name('falcon.info');

// Save the personal info and redirect to package selection
Route::post('/presale/info/save', [PromoFalconLongController::class, 'saveInfo'])->name('falcon.saveInfo');

// Show the package selection page (step 2)
Route::get('/presale/packages', [PromoFalconLongController::class, 'showPackages'])->name('falcon.packages');

Route::post('/presale/packages/select', [PromoFalconLongController::class, 'selectPackage'])->name('falcon.packages.select');

// Show the checkout page (step 4)
Route::get('/presale/checkout', [PromoFalconLongController::class, 'checkout'])->name('falcon.checkout');

// Handle final order submission (step 5)
Route::post('/order', [PromoFalconLongController::class, 'store'])->name('falcon.order');