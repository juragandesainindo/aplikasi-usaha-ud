<?php

use App\Http\Controllers\laporan\BulanController;
use App\Http\Controllers\laporan\GrandTotalController;
use App\Http\Controllers\laporan\HarianController;
use App\Http\Controllers\laporan\TahunanController;
use App\Http\Controllers\menu\DashboardController;
use App\Http\Controllers\menu\DatausahaController;
use App\Http\Controllers\menu\PeriodeController;
use App\Http\Controllers\produksi\PembelianController;
use App\Http\Controllers\produksi\PenjualanController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// #################### Menu Utama ####################
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('data-usaha', DatausahaController::class);

Route::get('periode', [PeriodeController::class, 'index']);
Route::get('periode/{id}/{slug}', [PeriodeController::class, 'show'])->name('periode.show');
Route::post('periode-produksi', [PeriodeController::class, 'store'])->name('periode-produksi.store');
Route::put('periode-produksi/{id}', [PeriodeController::class, 'update'])->name('periode-produksi.update');
Route::delete('periode-produksi/{id}', [PeriodeController::class, 'destroy'])->name('periode-produksi.destroy');


// #################### Produksi Pembelian ####################
Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian');

Route::get('pembelian-periode/{id}/{slug}', [PembelianController::class, 'periode'])->name('pembelian-periode');
Route::post('pembelian-periode', [PembelianController::class, 'storePeriode'])->name('pembelian-periode.store');
Route::put('pembelian-periode/{id}', [PembelianController::class, 'updatePeriode'])->name('pembelian-periode.update');
Route::delete('pembelian-periode/{id}', [PembelianController::class, 'destroyPeriode'])->name('pembelian-periode.destroy');

Route::get('pembelian-periode-produksi/{id}/{slug}', [PembelianController::class, 'produksi'])->name('pembelian-periode-produksi');
Route::post('pembelian-periode-produksi', [PembelianController::class, 'storeProduksi'])->name('pembelian-periode-produksi.store');
Route::put('pembelian-periode-produksi/{id}', [PembelianController::class, 'updateProduksi'])->name('pembelian-periode-produksi.update');
Route::delete('pembelian-periode-produksi/{id}', [PembelianController::class, 'destroyProduksi'])->name('pembelian-periode-produksi.destroy');

// #################### Produksi Penjualan ####################
Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::get('penjualan-periode/{id}/{slug}', [PenjualanController::class, 'periode'])->name('penjualan-periode');
Route::post('penjualan-periode', [PenjualanController::class, 'storePeriode'])->name('penjualan-periode.store');

Route::get('penjualan-periode-produksi/{id}/{slug}', [PenjualanController::class, 'produksi'])->name('penjualan-periode-produksi');
Route::post('penjualan-periode-produksi-penjualan', [PenjualanController::class, 'storeProduksi'])->name('penjualan-periode-produksi-penjualan.store');
Route::put('penjualan-periode-produksi-penjualan/{id}', [PenjualanController::class, 'updateProduksi'])->name('penjualan-periode-produksi-penjualan.update');
Route::delete('penjualan-periode-produksi-penjualan/{id}', [PenjualanController::class, 'destroyProduksi'])->name('penjualan-periode-produksi-penjualan.destroy');

Route::post('penjualan-periode-produksi-biaya', [PenjualanController::class, 'storeBiaya'])->name('penjualan-periode-produksi-biaya.store');
Route::put('penjualan-periode-produksi-biaya/{id}', [PenjualanController::class, 'updateBiaya'])->name('penjualan-periode-produksi-biaya.update');
Route::delete('penjualan-periode-produksi-biaya/{id}', [PenjualanController::class, 'destroyBiaya'])->name('penjualan-periode-produksi-biaya.destroy');

Route::post('penjualan-periode-produksi-gaji', [PenjualanController::class, 'storeGaji'])->name('penjualan-periode-produksi-gaji.store');
Route::delete('penjualan-periode-produksi-gaji/{id}', [PenjualanController::class, 'destroyGaji'])->name('penjualan-periode-produksi-gaji.destroy');

Route::post('penjualan-periode-produksi-sisa', [PenjualanController::class, 'storeSisa'])->name('penjualan-periode-produksi-sisa.store');
Route::delete('penjualan-periode-produksi-sisa/{id}', [PenjualanController::class, 'destroySisa'])->name('penjualan-periode-produksi-sisa.destroy');

// #################### Laporan Harian ####################
Route::get('laporan-harian', [HarianController::class, 'index']);
Route::get('laporan-harian/{id}/{slug}', [HarianController::class, 'show'])->name('laporan-harian.show');
Route::get('laporan-harian-preview/{id}/{slug}', [HarianController::class, 'preview'])->name('laporan-harian.preview');
Route::get('laporan-harian-cetak/{id}/{slug}', [HarianController::class, 'cetak'])->name('laporan-harian.cetak');

Route::get('laporan-bulanan', [BulanController::class, 'index']);
Route::get('laporan-bulanan/{id}', [BulanController::class, 'show'])->name('laporan-bulanan.show');
Route::get('laporan-bulanan-cetak/{id}', [BulanController::class, 'cetak'])->name('laporan-bulanan.cetak');

Route::get('laporan-tahunan', [TahunanController::class, 'index']);
Route::get('laporan-tahunan/{id}', [TahunanController::class, 'show'])->name('laporan-tahunan.show');
Route::get('laporan-tahunan-cetak/{id}', [TahunanController::class, 'cetak'])->name('laporan-tahunan.cetak');

Route::get('laporan-grand-total', [GrandTotalController::class, 'index']);
Route::get('laporan-grand-total/{id}', [GrandTotalController::class, 'show'])->name('laporan-grand-total.show');