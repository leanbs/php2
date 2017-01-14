<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/** General routes */
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@home');
Route::get('howto', 'HomeController@help');

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

/** Registration routes */
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

/** Management inventory route */
Route::get('manage/inventori', 'InventoryController@manage');
Route::resource('inventori', 'InventoryController');
Route::get('manage/tipemerk', 'PagesController@getTipeMerkManage');

/** Management Kategori and Merk route */
Route::resource('kategori', 'KategoriController');
Route::resource('merk', 'MerkController');

/** Management toko route */
Route::get('manage/toko', 'TokoController@manage');
Route::resource('toko', 'TokoController', ['middleware' => 'auth']);

/** Management akun route */
Route::get('manage/akun', 'AkunController@manage');
Route::resource('akun', 'AkunController');

/** Management karyawan route */
Route::get('manage/karyawan', 'KaryawanController@manage');
Route::resource('karyawan', 'KaryawanController');


/** Management gaji route */
Route::get('manage/gaji', 'GajiController@manage');
Route::resource('gaji', 'GajiController');


/** Management hutang route */
Route::get('manage/hutang', 'KaryawanController@manage_hutang');
Route::resource('hutang', 'HutangController');
Route::resource('hutang/status_lns', 'HutangController@statusHutangChanger');

/** Management transaksi route */
Route::get('manage/transaksi', 'TransaksiController@manage');
Route::resource('transaksi', 'TransaksiController');

/** transaksi detail data AJAX load route */
Route::get('transaksi/view/{id}', 'PagesController@getTransaksi');
Route::get('transaksi/status_byr/{id}', 'TransaksiController@statusBayar');
Route::get('transaksi/status_krm/{id}', 'TransaksiController@statusKirim');


/** Management input data master route*/
Route::get('manage/datamaster', 'PagesController@getDataMasterManage');
Route::resource('jeniskelamin', 'JenisKelaminController');
Route::resource('jenistransaksi', 'JenisTransaksiController');

/** Management Kontak route*/
Route::get('manage/kontak', 'KontakController@manage');
Route::resource('kontak', 'KontakController');

/** Management Presensi route*/
Route::get('manage/presensi', 'PresensiController@manage');
Route::resource('presensi', 'PresensiController');

Route::get('testing', 'TransaksiController@getMonthlySales');
Route::get('testing2', 'PagesController@test123');
Route::get('testing3', 'GajiController@viewGaji');
Route::get('testng', 'PagesController@getNoNota');
Route::get('testers', 'PagesController@testers');

Route::resource('detiltransaksi', 'DetilTransaksiController');
Route::get('hitGaji', 'PagesController@hitGaji');

Route::get('api/getInventori', 'InventoryController@getInventori');
Route::get('api/getNoNota', 'PagesController@getNoNota');
Route::get('api/getTransaksiLists', 'TransaksiController@getTransaksiLists');
Route::get('api/updateInventory/stok/{stok}/tipe_brg/{tipe_brg}/operator/{operator}', 'TransaksiController@updateInventory');
Route::get('api/getKaryawan', 'KaryawanController@getKaryawan');
Route::get('api/getToko', 'TokoController@getToko');
Route::get('api/getJenisTransaksi', 'JenisTransaksiController@getJenisTransaksi');

/** Report route*/
Route::get('report/TransaksiMonthly', 'PDFController@getTransaksiReportMonthly'); //transaksi
Route::get('report/InventoriAll', 'PDFController@getInventoryReport'); //barang
Route::get('report/KaryawanAll', 'PDFController@getKaryawanReport');
Route::get('report/GajiAll', 'PDFController@getGajiReport');
Route::get('report/HutangAll', 'PDFController@getHutangReport');
Route::get('report/GajiMonthly/{month}', 'PDFController@getGajiReportMonthly');

Route::get('tests/{stok}', 'PagesController@hitGajiBulanan');

/** New Presensi route */
Route::get('presensiview', 'PresensiController@getPresensiView');
Route::get('get/presensi', 'PresensiController@getPresensiCbx');
Route::get('make/presensi', 'PresensiController@makePresensiData');
Route::get('set/presensi', 'PresensiController@setPresensiData');
Route::post('fortesting', 'PresensiController@fortesting');
Route::get('val', 'PresensiController@testQuery');

Route::get('search/presensi/{month}/{year}', 'PresensiController@searchPerDatatable');
