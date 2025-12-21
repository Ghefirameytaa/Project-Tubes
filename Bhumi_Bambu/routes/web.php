<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [LoginController::class, 'login'])->name('login'); // tampilkan form login
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate'); // proses login


//dashboard//
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

});
// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');


Route::get('/pembayaran', [PembayaranController::class, 'index']);
Route::get('/pembayaran/create', [PembayaranController::class, 'create']);
Route::post('/pembayaran', [PembayaranController::class, 'store']);
Route::get('/pembayaran/show', [PembayaranController::class, 'show']); 
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit']);
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);

// Route::get('/', function () {
//     return view('welcome');
// });
/*
| Public
*/

/*
| Public
*/

Route::get('/', function () {
    return view('landingpage.index');
});
// Route::get('', function () {
//     return view('welcome');
// });

/*
/ Admin Promo CRUD
/
*/

Route::middleware(['auth'])->group(function () {

    // READ - List promo
    Route::get('/admin/promo', [PromoController::class, 'index'])->name('promo.index');

    // CREATE - Form tambah promo
    Route::get('/admin/promo/create', [PromoController::class, 'create'])->name('promo.create');
    // CREATE - Simpan promo
    Route::post('/admin/promo', [PromoController::class, 'store'])->name('promo.store');

    // EDIT - Form edit promo
    Route::get('/admin/promo/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    // UPDATE - Simpan perubahan promo
    Route::put('/admin/promo/{id}', [PromoController::class, 'update'])->name('promo.update');

    // DELETE - Hapus promo
    Route::delete('/admin/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');
});


/*
/ User Apply Promo
/
*/

Route::post('/apply-promo', [PemesananController::class, 'applyPromo'])->name('apply.promo');

// Route::get('/login', function () {
//     return view('login');   
// })->name('login');
// Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
// Route::get('/login', [LoginController::class, 'index'])->name('login');

use App\Http\Controllers\PaketLayananController;

// Route::middleware(['auth'])->group(function () {
Route::resource('paket-layanan', PaketLayananController::class);
