<?php

use App\Http\Controllers\LandingPageController;


Route::get('/', [LandingPageController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });
