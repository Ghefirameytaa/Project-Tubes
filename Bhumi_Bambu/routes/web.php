<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PromoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;

Route::get('/', function () {
    return redirect()->route('pesanan.index');
});

Route::resource('pesanan', PesananController::class)->only([
    'index','store','update','destroy'
]);
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\AuthController;



Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])

        ->name('dashboard')
        ->middleware('auth');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/login', [LoginController::class, 'login'])->name('login'); // tampilkan form login
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate'); // proses login


//dashboard//
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

});
// Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');


Route::get('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/login', function () {
    return view('login');   
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');





// READ - List semua pembayaran (dengan filter & search)

Route::get('/pembayaran', [PembayaranController::class, 'index']);

// CREATE - Form tambah pembayaran baru
Route::get('/pembayaran/create', [PembayaranController::class, 'create']);

// CREATE - Simpan data pembayaran baru
Route::post('/pembayaran', [PembayaranController::class, 'store']);


// READ - Detail pembayaran tertentu (SHOW)

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

