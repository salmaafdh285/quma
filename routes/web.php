<?php

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
//     // return view('welcome');
//     return redirect('login');
// });

Route::get('/', function () {
    //return view('dashboardbootstrap');
    //return redirect('login');
    return view('welcome');
});

// Route::get('/contoh1',
//    [App\Http\Controllers\Contoh1Controller::class, 'show']
// );

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');


// untuk master data debt
// jika ingin menambahkan routes baru selain default resource di tambah di awal
// sebelum route resource
Route::get('/debt/fetchdebt', [App\Http\Controllers\DebtController::class,'fetchdebt'])->middleware(['auth']);
Route::get('/debt/edit/{id}', [App\Http\Controllers\DebtController::class,'edit'])->middleware(['auth']);
Route::get('/debt/destroy/{id}', [App\Http\Controllers\DebtController::class,'destroy'])->middleware(['auth']);
Route::resource('debt', App\Http\Controllers\DebtController::class)->middleware(['auth']);


// untuk master data expense
// jika ingin menambahkan routes baru selain default resource di tambah di awal
// sebelum route resource
Route::get('/expense/fetchexpense', [App\Http\Controllers\ExpenseController::class,'fetchexpense'])->middleware(['auth']);
Route::get('/expense/edit/{id}', [App\Http\Controllers\ExpenseController::class,'edit'])->middleware(['auth']);
Route::get('/expense/destroy/{id}', [App\Http\Controllers\ExpenseController::class,'destroy'])->middleware(['auth']);
Route::resource('expense', App\Http\Controllers\ExpenseController::class)->middleware(['auth']);

// untuk master data income
// jika ingin menambahkan routes baru selain default resource di tambah di awal
// sebelum route resource
Route::get('/income/fetchincome', [App\Http\Controllers\IncomeController::class,'fetchincome'])->middleware(['auth']);
Route::get('/income/edit/{id}', [App\Http\Controllers\IncomeController::class,'edit'])->middleware(['auth']);
Route::get('/income/destroy/{id}', [App\Http\Controllers\IncomeController::class,'destroy'])->middleware(['auth']);
Route::resource('income', App\Http\Controllers\IncomeController::class)->middleware(['auth']);


// untuk transaksi penjualan
Route::get('penjualan/barang/{id}', [App\Http\Controllers\PenjualanController::class,'getDataBarang'])->middleware(['auth']);
Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang'])->middleware(['auth']);
Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail'])->middleware(['auth']);
Route::get('penjualan/barang', [App\Http\Controllers\PenjualanController::class,'getDataBarangAll'])->middleware(['auth']);
Route::get('penjualan/jmlbarang', [App\Http\Controllers\PenjualanController::class,'getJumlahBarang'])->middleware(['auth']);
Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson'])->middleware(['auth']);
Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout'])->middleware(['auth']);
Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice'])->middleware(['auth']);
Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice'])->middleware(['auth']);
Route::resource('penjualan', App\Http\Controllers\PenjualanController::class)->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang'])->middleware(['auth']);
Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus'])->middleware(['auth']);
Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus'])->middleware(['auth']);
Route::get('pembayaran/approve/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'approve'])->middleware(['auth']);
Route::get('pembayaran/unapprove/{no_transaksi}', [App\Http\Controllers\PembayaranController::class,'unapprove'])->middleware(['auth']);
Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class)->middleware(['auth']);

// laporan
Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);

// untuk master data akun
Route::resource('akun', App\Http\Controllers\AkunController::class)->middleware(['auth']);
Route::get('/akun/destroy/{id}', [App\Http\Controllers\AkunController::class,'destroy'])->middleware(['auth']);

// // untuk master data perusahaan
// Route::resource('perusahaan', App\Http\Controllers\PerusahaanController::class)->middleware(['auth']);
// Route::get('/perusahaan/destroy/{id}', [App\Http\Controllers\PerusahaanController::class,'destroy'])->middleware(['auth']);

// untuk master data daftar
Route::resource('daftar', App\Http\Controllers\DaftarController::class)->middleware(['auth']);
Route::get('/daftar/destroy/{id}', [App\Http\Controllers\DaftarController::class,'destroy'])->middleware(['auth']);

// master data pemasukan
Route::get('/pemasukan/fetchpemasukan', [App\Http\Controllers\PemasukanController::class,'fetchpemasukan'])->middleware(['auth']);
Route::get('/pemasukan/edit/{id}', [App\Http\Controllers\PemasukanController::class,'edit'])->middleware(['auth']);
Route::get('/pemasukan/destroy/{id}', [App\Http\Controllers\PemasukanController::class,'destroy'])->middleware(['auth']);
Route::resource('pemasukan', App\Http\Controllers\PemasukanController::class)->middleware(['auth']);

// master data pengeluarann
Route::get('/pengeluarann/fetchpengeluarann', [App\Http\Controllers\PengeluarannController::class,'fetchpengeluarann'])->middleware(['auth']);
Route::get('/pengeluarann/edit/{id}', [App\Http\Controllers\PengeluarannController::class,'edit'])->middleware(['auth']);
Route::get('/pengeluarann/destroy/{id}', [App\Http\Controllers\PengeluarannController::class,'destroy'])->middleware(['auth']);
Route::resource('pengeluarann', App\Http\Controllers\PengeluarannController::class)->middleware(['auth']);


require __DIR__.'/auth.php';

