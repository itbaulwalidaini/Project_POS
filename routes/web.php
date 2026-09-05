<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\KelompokSatuanController;
use App\Http\Controllers\KeteranganStokController;
use App\Http\Controllers\StokAwalController;
use App\Http\Controllers\StokOpnameController;
use App\Http\Controllers\PenyesuaianStokController;
use App\Http\Controllers\RealisasiPembelianController;

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('pages.satuan.index');
});

Route::resource('produk', ProdukController::class);
Route::resource('pelanggan', PelangganController::class);


Route::resource('stok-awal', StokAwalController::class);
Route::resource('stok-opname', StokOpnameController::class);
Route::resource('penyesuaian-stok', PenyesuaianStokController::class);

Route::resource('perencanaan', PerencanaanController::class);
Route::resource('realisasi-pembelian', RealisasiPembelianController::class);

Route::resource('kategori', KategoriController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('kelompok-satuan', KelompokSatuanController::class);
Route::resource('keterangan-stok', KeteranganStokController::class);
