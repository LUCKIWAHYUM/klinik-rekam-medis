<?php

use App\Http\Controllers\DetailRekamMedisController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\DetailresepobatController;
use App\Http\Controllers\DetailPembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/cetakrekammedis', function () {
    return view('pages.cetakrekammedis');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware();
Route::get('/create', 'PasienController@create')->name('pasien.create');
Route::get('/obat', 'ObatController@index');
// Route::get('/kunjungan', [KunjunganController::class, 'index']);




Route::resource('user', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('pasien', 'App\Http\Controllers\PasienController')->middleware('auth');
Route::resource('kunjungan', 'App\Http\Controllers\KunjunganController')->middleware('auth');
Route::resource('pemeriksaan', 'App\Http\Controllers\PemeriksaanController')->middleware('auth');
Route::resource('tindakan', 'App\Http\Controllers\TindakanController')->middleware('auth');
Route::resource('obat', 'App\Http\Controllers\ObatController')->middleware('auth');
Route::resource('pemeriksaandokter', 'App\Http\Controllers\PemeriksaandokterController')->middleware('auth');
Route::resource('rekammedis', 'App\Http\Controllers\RekammedisController')->middleware('auth');
Route::resource('resepobat', 'App\Http\Controllers\ResepobatController')->middleware('auth');
Route::resource('obatpasien', 'App\Http\Controllers\ObatpasienController')->middleware('auth');
Route::resource('supplier', 'App\Http\Controllers\SupplierController')->middleware('auth');
Route::resource('detail', 'App\Http\Controllers\DetailresepobatController')->middleware('auth');
Route::resource('pembayaran', 'App\Http\Controllers\PembayaranController')->middleware('auth');
Route::resource('detailpembayaran', 'App\Http\Controllers\DetailPembayaranController')->middleware('auth');
Route::resource('detailrekmed', 'App\Http\Controllers\DetailRekamMedisController')->middleware('auth');
Route::resource('detailperiksa', 'App\Http\Controllers\DetailPeriksaController')->middleware('auth');
Route::resource('laporan-kunjungan', 'App\Http\Controllers\LaporanController')->middleware('auth');
Route::resource('rekapobat', 'App\Http\Controllers\rekapobatController')->middleware('auth');
Route::resource('rekaptindakan', 'App\Http\Controllers\rekaptindakanController')->middleware('auth');
Route::get('/cetak-antrian/{id}',  [KunjunganController::class, 'cetakAntrian']);
Route::get('/cetak-laporan/{bulan}/{tahun}',  [LaporanController::class, 'cetak']);
Route::get('/cetak/{id}',  [DetailresepobatController::class, 'cetak']);
Route::get('/cetak-rekmed/{id}',  [DetailRekamMedisController::class, 'cetak']);
Route::get('/cetak-nota/{id}',  [DetailPembayaranController::class, 'cetak']);
