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

Route::group(
  [
  ],
  function () {
      // if not otherwise configured, setup the auth routes
          // Authentication Routes...
          Route::get('login', 'Auth\LoginController@showLoginForm')->name('revised.auth.login');
          Route::post('login', 'Auth\LoginController@login');
          Route::get('logout', 'Auth\LoginController@logout')->name('revised.auth.logout');
          Route::post('logout', 'Auth\LoginController@logout');
  
          // Registration Routes...
          Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('revised.auth.register');
          Route::post('register', 'Auth\RegisterController@register');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('konten/{id}','KontenController@show')->name('show');
Route::get('createnew','KontenController@createview')->name('buatkonten');
Route::post('createnew','KontenController@storeKonten');
Route::post('konten/{konten}','KontenController@storedonasi')->name('isiDonasi');
Route::post('konten/perkembangan/{konten}','PerkembanganController@store')->name('perkembangan');
Route::post('konten/verifikasi/{konten}','KontenController@konfirmasidonasi')->name('verifikasi');
Route::post('konten/Perpanjangan/{id}','PerpanjanganController@store')->name('Perpanjangan');
Route::get('cari','CariController@index');
Route::get('/cari/hasil', 'CariController@getjudul')->name('getjudul');