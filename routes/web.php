<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\PromoFalconController;
use App\Http\Controllers\SpecialController;
use App\Http\Controllers\RemoveAccountController;
use App\Http\Controllers\PromoSamatorController;
use App\Http\Controllers\RefferalController;
use App\Http\Controllers\PromoFalconLongController;


// Route::resource('/', AdsController::class);
Route::resource('/', PromoFalconController::class);

//special deal
// Route::resource('/special-deal', SpecialController::class);
//remove account
// Route::resource('/remove-account', RemoveAccountController::class);
//refferal
// Route::controller(RefferalController::class)->group(function () {
//     Route::get('/refferal/question/{id}', 'question');
//     Route::post('/refferal/save-guest', 'saveGuest');
//     Route::post('/refferal/unlock-membership', 'unlockMembership');
//     Route::post('/refferal/choose-package', 'choosePackage');
//     Route::post('/refferal/order', 'order');
// });
// Route::resource('/refferal', RefferalController::class);

//falcon
Route::resource('/falcon', PromoFalconController::class);
Route::post('/order', [PromoFalconController::class, 'order']);

//graha
// Route::resource('/graha', PromoGrahaController::class);
// Route::post('/order', [PromoGrahaController::class, 'order']);

/**
 * long
 */

// Route::resource('/sales', PromoFalconLongController::class);
// Route::post('/order', [PromoFalconLongController::class, 'order']);

Route::get('/login', [PromoFalconLongController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [PromoFalconLongController::class, 'login'])->name('login');

// Show the personal info form (step 1)
Route::get('/sales', [PromoFalconLongController::class, 'showInfoForm'])->name('falconlong.info');

// Save the personal info and redirect to package selection
Route::post('/presale/info/save', [PromoFalconLongController::class, 'saveInfo'])->name('falconlong.saveInfo');

// // Show the package selection page (step 2)
Route::get('/presale/packages', [PromoFalconLongController::class, 'showPackages'])->name('falconlong.packages');


Route::get('/show-checkout-form', [PromoFalconLongController::class, 'showCheckoutForm'])->name('falconlong.showCheckoutForm');


// Handle package selection and redirect to checkout (step 3)

Route::post('/presale/packages/select', [PromoFalconLongController::class, 'selectPackage'])->name('falconlong.packages.select');

// Show the checkout page (step 4)

Route::post('/checkout', [PromoFalconLongController::class, 'checkout'])->name('falconlong.checkout');


// Handle final order submission (step 5)
// Route::post('/order', [PromoFalconLongController::class, 'store'])->name('falconlong.order');

Route::post('/order', [PromoFalconLongController::class, 'order'])->name('falconlong.order');



// // Handle final order submission (step 5)
// Route::post('/order', [PromoFalconLongController::class, 'store'])->name('falconlong.order');