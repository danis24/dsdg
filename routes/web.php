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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@browse')->name("user.index");
Route::get('/users/add', 'UserController@add')->name("user.add");
Route::post('/users/add', 'UserController@store')->name("user.store");
Route::get('/users/{id}', 'UserController@read')->name("user.read");
Route::get('/users/edit/{id}', 'UserController@edit')->name("user.edit");
Route::post('/users/edit/{id}', 'UserController@update')->name("user.update");
Route::post('/users/delete', 'UserController@delete')->name("user.delete");

Route::get('/penduduk', 'PendudukController@browse')->name("penduduk.index");
Route::get('/penduduk/detail/{id}', 'PendudukController@read')->name("penduduk.read");
Route::get('/penduduk/add', 'PendudukController@add')->name("penduduk.add");
Route::post('/penduduk/add', 'PendudukController@store')->name("penduduk.store");
Route::get('/penduduk/edit/{id}', 'PendudukController@edit')->name("penduduk.edit");
Route::post('/penduduk/edit/{id}', 'PendudukController@update')->name("penduduk.update");
Route::post('/penduduk/delete', 'PendudukController@delete')->name("penduduk.delete");
Route::post('/penduduk/check', 'PendudukController@check')->name("penduduk.check");
Route::get('/penduduk/import', 'PendudukController@import')->name("penduduk.import");
Route::get('/penduduk/export', 'PendudukController@export')->name("penduduk.export");
Route::post('/penduduk/import_excel', 'PendudukController@importExcel')->name("penduduk.importExcel");

Route::get('/riwayat', 'RiwayatController@browse')->name("riwayat.index");
Route::post('/pengajuan', 'RiwayatController@store')->name("pengajuan.store");
Route::get('/prints', 'RiwayatController@prints')->name("pengajuan.prints");
Route::post('/pengajuan/check', 'RiwayatController@check')->name("pengajuan.check");
Route::get('/pdf/{nik}', 'RiwayatController@generatePDF')->name("print.pdf");
