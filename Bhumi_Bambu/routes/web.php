<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\PaketLayananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
// use App\Http\Controllers\LandingPageController;
// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\PesananController;
// use App\Http\Controllers\PembayaranController;
// use App\Http\Controllers\PromoController;
// use App\Http\Controllers\PaketLayananController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| LOGIN & LOGOUT (TIDAK MAKSA AUTH KE PEMESANAN)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/login', function () {
    return view('login');   
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

//paket layanan//
// Route::middleware(['auth'])->group(function () {
Route::resource('paket-layanan', PaketLayananController::class);



// READ - List semua pembayaran (dengan filter & search)
Route::get('/pembayaran', [PembayaranController::class, 'index']);

// CREATE - Form tambah pembayaran baru
Route::get('/pembayaran/create', [PembayaranController::class, 'create']);

// CREATE - Simpan data pembayaran baru
Route::post('/pembayaran', [PembayaranController::class, 'store']);
return redirect('/pembayaran')->with('success', 'Pembayaran berhasil ditambahkan');

// READ - Detail pembayaran tertentu
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show']);

// UPDATE - Form edit pembayaran
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit']);

// UPDATE - Simpan perubahan pembayaran
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update']);

// DELETE - Hapus pembayaran
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy']);

// BONUS - Verifikasi pembayaran (Approve/Reject)
Route::post('/pembayaran/{id}/verify', [PembayaranController::class, 'verify']);

// Route::get('/', function () {
//     return view('welcome');
// });
/*
| Public
*/

/*
|--------------------------------------------------------------------------
| PEMESANAN (INI YANG KAMU PAKAI)
| URL: /pemesanan
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('pesanan.index');
});

Route::resource('pesanan', PesananController::class)->only([
    'index','store','update','destroy'
]);


/*
|--------------------------------------------------------------------------
| PEMBAYARAN (TETAP, TIDAK DIUBAH)
|--------------------------------------------------------------------------
*/
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayaran.show');
Route::get('/pembayaran/{id}/edit', [PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('/pembayaran/{id}', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

/*
|--------------------------------------------------------------------------
| PROMO (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/admin/promo', [PromoController::class, 'index'])->name('promo.index');
    Route::get('/admin/promo/create', [PromoController::class, 'create'])->name('promo.create');
    Route::post('/admin/promo', [PromoController::class, 'store'])->name('promo.store');
    Route::get('/admin/promo/{id}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/admin/promo/{id}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/admin/promo/{id}', [PromoController::class, 'destroy'])->name('promo.destroy');
});

/*
|--------------------------------------------------------------------------
| PAKET LAYANAN
|--------------------------------------------------------------------------
*/

Route::post('/apply-promo', [PemesananController::class, 'applyPromo'])->name('apply.promo');

Route::resource('paket-layanan', PaketLayananController::class);

