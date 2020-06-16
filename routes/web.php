<?php

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



Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/{rt?}', 'AdminController@menu')->name('admin');
Route::get('/admin/{rt?}/data-kk', 'AdminController@dataKK')->name('admin');
Route::post('/admin/{rt?}/data-kk/update', 'AdminController@updateDataKKFix')->name('admin');
Route::get('/admin/{rt?}/data-kk/hapus/{id?}', 'AdminController@hapusDataKKFix')->name('admin');
Route::get('/admin/{rt?}/data-kk/detail/{id?}', 'AdminController@detailDataKK')->name('admin');
Route::get('/admin/{rt?}/data-masuk', 'AdminController@dataMasuk')->name('admin');
Route::get('/admin/{rt?}/data-masuk/hapus/{id?}', 'AdminController@hapusDataKK')->name('admin');
Route::post('/admin/{rt?}/update-kk/', 'AdminController@updateDataKK')->name('admin');
Route::get('/admin/{rt?}/rekap-pekerjaan/', 'AdminController@rekapPekerjaan')->name('admin');
Route::get('/admin/{rt?}/rekap-pendidikan/', 'AdminController@rekapPendidikan')->name('admin');
Route::get('/admin/{rt?}/rekap-usia/', 'AdminController@rekapUsia')->name('admin');
Route::get('/admin/{rt?}/laporan-masuk/', 'AdminController@laporanMasuk')->name('admin');

Route::get('/', 'PendudukController@index');
Route::get('/add-data-kk', 'PendudukController@addKK');
Route::get('/cari-kk', 'PendudukController@cariKK');
Route::post('/temukan-kk', 'PendudukController@temukanKK');
Route::get('/lihat-data/{no_kk?}/{token?}', 'PendudukController@lihatKK');
Route::post('/lihat-data/{no_kk?}/{token?}/update-kk/', 'PendudukController@updateDataKK');
Route::post('/lihat-data/{no_kk?}/{token?}/tambah-anggota/', 'PendudukController@tambahAnggotaKeluarga');
Route::post('/lihat-data/{no_kk?}/{token?}/update-anggota/', 'PendudukController@updateAnggotaKeluarga');
Route::get('/lihat-data/{no_kk?}/{token?}/hapus-anggota/{id?}', 'PendudukController@hapusAnggotaKeluarga');
Route::post('/lihat-data/{no_kk?}/{token?}/tambah-laporan/', 'PendudukController@tambahLaporan');

Route::post('/save-kk', 'PendudukController@saveKK');
