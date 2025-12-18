<?php

use App\Http\Controllers\LandingPageController;
use App\Models\Pembayaran;


Route::get('/', [LandingPageController::class, 'index']);


// Route::get('/', function () {
//     return view('welcome');
// });
